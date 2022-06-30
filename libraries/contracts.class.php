<?php

class contracts {

	private $uzsakymai_lentele = '';
	private $klientai_lentele = '';
	private $uzsakytos_paslaugos_lentele = '';
	private $parduotuviu_lentele = '';
	
	public function __construct() {
		$this->uzsakymai_lentele = config::DB_PREFIX . 'Uzsakymas';
		$this->klientai_lentele = config::DB_PREFIX . 'Klientas';
		$this->uzsakytos_paslaugos_lentele = config::DB_PREFIX . 'Uzsakyta_Paslauga';
		$this->parduotuviu_lentele = config::DB_PREFIX . 'Parduotuve';
	}

	public function getCustomerContracts($dateFrom, $dateTo, $ordersTo, $servicesTo) {
		$dateFrom = mysql::escapeFieldForSQL($dateFrom);
		$dateTo = mysql::escapeFieldForSQL($dateTo);
        $ordersTo = mysql::escapeFieldForSQL($ordersTo);
        $servicesTo = mysql::escapeFieldForSQL($servicesTo);

		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`data`<='{$dateTo}'";
			}
            if(!empty($ordersTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            }
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
		} else if(!empty($dateTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`data`<='{$dateTo}'";
            if(!empty($ordersTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            }
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
		} else if(!empty($ordersTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($servicesTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
        }

		$query = "  SELECT  `{$this->uzsakymai_lentele}`.`kodas`,
							`{$this->uzsakymai_lentele}`.`data`,
							`{$this->klientai_lentele}`.`id_Klientas`,
							`{$this->klientai_lentele}`.`vardas`,
						    `{$this->klientai_lentele}`.`pavarde`,
						    `{$this->uzsakymai_lentele}`.`kaina` as `sutarties_kaina`,
                            `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`,
                            abs(sum(`{$this->uzsakymai_lentele}`.`kaina`)) AS `viso_isleido`,
                            YEAR(`{$this->uzsakymai_lentele}`.`data`) AS `pirkimo_metai`,
                            MONTHNAME(`{$this->uzsakymai_lentele}`.`data`) AS `pirkimo_menesis`,
						    IFNULL(sum(`{$this->uzsakytos_paslaugos_lentele}`.`kiekis` * `{$this->uzsakytos_paslaugos_lentele}`.`kaina`), 0) as `sutarties_paslaugu_kaina`,
						    `t`.`bendra_kliento_sutarciu_kaina`,
						    `s`.`bendra_kliento_paslaugu_kaina`
					FROM `{$this->uzsakymai_lentele}`
						INNER JOIN `{$this->klientai_lentele}`
							ON `{$this->uzsakymai_lentele}`.`fk_Klientasid_Uzsakymas`=`{$this->klientai_lentele}`.`id_Klientas`
						LEFT JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->uzsakymai_lentele}`.`kodas`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_Uzsakymas_kodas_paslauga`
						INNER JOIN (
							SELECT `id_Klientas`,
									sum(`{$this->uzsakymai_lentele}`.`kaina`) AS `bendra_kliento_sutarciu_kaina`
							FROM `{$this->uzsakymai_lentele}`
								INNER JOIN `{$this->klientai_lentele}`
									ON `{$this->uzsakymai_lentele}`.`fk_Klientasid_Uzsakymas`=`{$this->klientai_lentele}`.`id_Klientas`
							{$whereClauseString}
							GROUP BY `id_Klientas`
						) `t` ON `t`.`id_Klientas`=`{$this->klientai_lentele}`.`id_Klientas`
						INNER JOIN (
							SELECT `id_Klientas`,
									IFNULL(sum(`{$this->uzsakytos_paslaugos_lentele}`.`kiekis` * `{$this->uzsakytos_paslaugos_lentele}`.`kaina`), 0) as `bendra_kliento_paslaugu_kaina`
							FROM `{$this->uzsakymai_lentele}`
								INNER JOIN `{$this->klientai_lentele}`
									ON `{$this->uzsakymai_lentele}`.`fk_Klientasid_Uzsakymas`=`{$this->klientai_lentele}`.`id_Klientas`
								LEFT JOIN `{$this->uzsakytos_paslaugos_lentele}`
									ON `{$this->uzsakymai_lentele}`.`kodas`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_Uzsakymas_kodas_paslauga`
								{$whereClauseString}							
								GROUP BY `id_Klientas`
						) `s` ON `s`.`id_Klientas`=`{$this->klientai_lentele}`.`id_Klientas`
					{$whereClauseString}
					GROUP BY `{$this->uzsakymai_lentele}`.`kodas` ORDER BY `{$this->klientai_lentele}`.`pavarde` ASC";
        $data = mysql::select($query);
		//
		return $data;
	}
	
	public function getSumPriceOfContracts($dateFrom, $dateTo, $ordersTo, $servicesTo) {
		$dateFrom = mysql::escapeFieldForSQL($dateFrom);
		$dateTo = mysql::escapeFieldForSQL($dateTo);
        $ordersTo = mysql::escapeFieldForSQL($ordersTo);

        $whereClauseString = "";
        if(!empty($dateFrom)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`data`>='{$dateFrom}'";
            if(!empty($dateTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`data`<='{$dateTo}'";
            }
            if(!empty($ordersTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            }
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($dateTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`data`<='{$dateTo}'";
            if(!empty($ordersTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            }
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($ordersTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($servicesTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
        }


        $query = "  SELECT sum(`{$this->uzsakymai_lentele}`.`kaina`) AS `uzsakymo_suma`
					FROM `{$this->uzsakymai_lentele}`
					{$whereClauseString}";
		$data = mysql::select($query);

		//
		return $data;
	}

	public function getSumPriceOfOrderedServices($dateFrom, $dateTo, $ordersTo, $servicesTo) {
		$dateFrom = mysql::escapeFieldForSQL($dateFrom);
		$dateTo = mysql::escapeFieldForSQL($dateTo);
        $servicesTo = mysql::escapeFieldForSQL($servicesTo);

        $whereClauseString = "";
        if(!empty($dateFrom)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`data`>='{$dateFrom}'";
            if(!empty($dateTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`data`<='{$dateTo}'";
            }
            if(!empty($ordersTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            }
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($dateTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`data`<='{$dateTo}'";
            if(!empty($ordersTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            }
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($ordersTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($servicesTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
        }


        $query = "  SELECT sum(`{$this->uzsakytos_paslaugos_lentele}`.`kiekis` * `{$this->uzsakytos_paslaugos_lentele}`.`kaina`) AS `paslaugu_suma`
					FROM `{$this->uzsakymai_lentele}`
						INNER JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->uzsakymai_lentele}`.`kodas`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_Uzsakymas_kodas_paslauga`
					{$whereClauseString}";
		$data = mysql::select($query);

		//
		return $data;
	}

    public function getShopOfOrderedServices($dateFrom, $dateTo, $ordersTo, $servicesTo) {
        $dateFrom = mysql::escapeFieldForSQL($dateFrom);
        $dateTo = mysql::escapeFieldForSQL($dateTo);
        $ordersTo = mysql::escapeFieldForSQL($ordersTo);
        $servicesTo = mysql::escapeFieldForSQL($servicesTo);

        $whereClauseString = "";
        if(!empty($dateFrom)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`data`>='{$dateFrom}'";
            if(!empty($dateTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`data`<='{$dateTo}'";
            }
            if(!empty($ordersTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            }
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($dateTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`data`<='{$dateTo}'";
            if(!empty($ordersTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            }
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($ordersTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($servicesTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
        }

        $query = "  SELECT `{$this->parduotuviu_lentele}`.`adresas` AS `parduotuve`
					FROM `{$this->uzsakymai_lentele}`
						INNER JOIN `{$this->parduotuviu_lentele}`
							ON `{$this->uzsakymai_lentele}`.`fk_Parduotuveid_Uzsakymas`=`{$this->parduotuviu_lentele}`.`id_Parduotuve`
					{$whereClauseString}";
        $data = mysql::select($query);

        //
        return $data;
    }

    public function getDeliveriesOrderedServices($dateFrom, $dateTo, $ordersTo, $servicesTo) {
        $dateFrom = mysql::escapeFieldForSQL($dateFrom);
        $dateTo = mysql::escapeFieldForSQL($dateTo);
        $ordersTo = mysql::escapeFieldForSQL($ordersTo);
        $servicesTo = mysql::escapeFieldForSQL($servicesTo);

        $whereClauseString = "";
        if(!empty($dateFrom)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`data`>='{$dateFrom}'";
            if(!empty($dateTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`data`<='{$dateTo}'";
            }
            if(!empty($ordersTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            }
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($dateTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`data`<='{$dateTo}'";
            if(!empty($ordersTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            }
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($ordersTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`kaina`<={$ordersTo}";
            if(!empty($servicesTo)) {
                $whereClauseString .= " AND `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
            }
        } else if(!empty($servicesTo)) {
            $whereClauseString .= " WHERE `{$this->uzsakymai_lentele}`.`uzsakymo_tipas`='{$servicesTo}'";
        }

        $query = "  SELECT `{$this->uzsakymai_lentele}`.`uzsakymo_tipas` AS `pristatymas`
					FROM `{$this->uzsakymai_lentele}`
					{$whereClauseString}";
        $data = mysql::select($query);

        //
        return $data;
    }

    public function getOrdersList($limit = null, $offset = null) {
        if($limit) {
            $limit = mysql::escapeFieldForSQL($limit);
        }
        if($offset) {
            $offset = mysql::escapeFieldForSQL($offset);
        }

        $limitOffsetString = "";
        if(isset($limit)) {
            $limitOffsetString .= " LIMIT {$limit}";

            if(isset($offset)) {
                $limitOffsetString .= " OFFSET {$offset}";
            }
        }

        $query = "  SELECT DISTINCT `uzsakymo_tipas`
					FROM `{$this->uzsakymai_lentele}`";
        $data = mysql::select($query);

        //
        return $data;
    }
}