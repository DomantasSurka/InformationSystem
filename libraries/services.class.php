<?php

class services {
	
	
	private $paslaugos_lentele = '';
	private $sutartys_lentele = '';
	private $paslaugu_kainos_lentele = '';
	private $uzsakytos_paslaugos_lentele = '';
	
	public function __construct() {
		$this->paslaugos_lentele = config::DB_PREFIX . 'Paslauga';
		$this->sutartys_lentele = config::DB_PREFIX . 'Saskaita';
		$this->paslaugu_kainos_lentele = config::DB_PREFIX . 'Paslaugos_Kaina';
		$this->uzsakytos_paslaugos_lentele = config::DB_PREFIX . 'Uzsakyta_Paslauga';
	}
	
	/**
	 * Paslaugų sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return paslaugų sąrašas pagal nurodytus rėžius
	 */
	public function getServicesList($limit = null, $offset = null) {
		if($limit) {
			$limit = mysql::escapeFieldForSQL($limit);
		}
		if($offset) {
			$offset = mysql::escapeFieldForSQL($offset);
		}
		
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		$query = "  SELECT *
					FROM `{$this->paslaugos_lentele}`" . $limitOffsetString;
		$data = mysql::select($query);

		//
		return $data;
	}
	
	/**
	 * Paslaugų kiekio radimas
	 * @return paslaugų kiekis
	 */
	public function getServicesListCount() {
		$query = "  SELECT COUNT(`{$this->paslaugos_lentele}`.`id_Paslauga`) as `kiekis`
					FROM `{$this->paslaugos_lentele}`";
		$data = mysql::select($query);
		
		//
		return $data[0]['kiekis'];
	}
	
	/**
	 * Paslaugos kainų sąrašo radimas
	 * @param type $serviceId
	 * @return paslaugos kainų sąrašas
	 */
	public function getServicePrices($serviceId) {
		$serviceId = mysql::escapeFieldForSQL($serviceId);
		
		$query = "  SELECT *
					FROM `{$this->paslaugu_kainos_lentele}`
					WHERE `fk_Paslaugaid_Paslauga`='{$serviceId}'";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	
	/**
	 * Sutarčių, į kurias įtraukta paslauga, kiekio radimas
	 * @param type $serviceId
	 * @return sutarčių kiekis
	 */
	public function getContractCountOfService($serviceId) {
		$serviceId = mysql::escapeFieldForSQL($serviceId);
		
		$query = "  SELECT COUNT(`{$this->sutartys_lentele}`.`numeris`) AS `kiekis`
					FROM `{$this->paslaugos_lentele}`
						INNER JOIN `{$this->paslaugu_kainos_lentele}`
							ON `{$this->paslaugos_lentele}`.`id_Paslauga`=`{$this->paslaugu_kainos_lentele}`.`fk_Paslaugaid_Paslauga`
						INNER JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->paslaugu_kainos_lentele}`.`fk_Paslaugaid_Paslauga`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_Paslaugos_Kainaid_Paslaugos_Kaina`
						INNER JOIN `{$this->sutartys_lentele}`
							ON `{$this->uzsakytos_paslaugos_lentele}`.`fk_Uzsakymas_kodas_paslauga`=`{$this->sutartys_lentele}`.`numeris`
					WHERE `{$this->paslaugos_lentele}`.`id_Paslauga`='{$serviceId}'";
		$data = mysql::select($query);
		
		//
		return $data[0]['kiekis'];
	}
	
	/**
	 * Paslaugos išrinkimas
	 * @param type $id
	 * @return paslaugos duomenų masyvas
	 */
	public function getService($id) {
		$id = mysql::escapeFieldForSQL($id);
		
		$query = "  SELECT *
					FROM `{$this->paslaugos_lentele}`
					WHERE `id_Paslauga`='{$id}'";
		$data = mysql::select($query);

		//
		return $data[0];
	}
	
	/**
	 * Paslaugos įrašymas
	 * @param type $data
	 * @return įrašytos paslaugos ID
	 */
	public function insertService($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);
		
		$query = "  INSERT INTO `{$this->paslaugos_lentele}`
								(
									`pavadinimas`,
									`aprasymas`
								)
								VALUES
								(
									'{$data['pavadinimas']}',
									'{$data['aprasymas']}'
								)";
		mysql::query($query);
		
		//
		return mysql::getLastInsertedId();
	}
	
	/**
	 * Paslaugos atnaujinimas
	 * @param type $data
	 */
	public function updateService($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);
		
		$query = "  UPDATE `{$this->paslaugos_lentele}`
					SET    `pavadinimas`='{$data['pavadinimas']}',
						   `aprasymas`='{$data['aprasymas']}'
					WHERE `id_Paslauga`='{$data['id_Paslauga']}'";
		mysql::query($query);
	}
	
	/**
	 * Paslaugos šalinimas
	 * @param type $id
	 */
	public function deleteService($id) {
		$id = mysql::escapeFieldForSQL($id);
		
		$query = "  DELETE FROM `{$this->paslaugos_lentele}`
					WHERE `id_Paslauga`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Paslaugos kainų įrašymas
	 * @param type $serviceId
	 * @param type $galiojaNuo
     * @param type $galiojaIki
	 * @param type $kaina
	 */
	public function insertServicePrices($serviceId, $galiojaNuo, $galiojaIki, $kaina) {
		$serviceId = mysql::escapeFieldForSQL($serviceId);
		$galiojaNuo = mysql::escapeFieldForSQL($galiojaNuo);
        $galiojaIki = mysql::escapeFieldForSQL($galiojaIki);
		$kaina = mysql::escapeFieldForSQL($kaina);
		
		$query = "  INSERT INTO `{$this->paslaugu_kainos_lentele}`
								(
									`fk_Paslaugaid_Paslauga`,
									`galioja_nuo`,
								    `galioja_iki`,
									`kaina_laikotarpiu`
								)
								VALUES
								(
									'{$serviceId}',
									'{$galiojaNuo}',
								    '{$galiojaIki}',
									'{$kaina}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Paslaugos kainos šalinimas
	 * @param type $serviceId
	 * @param type $galiojaNuo
     * @param type $galiojaIki
	 * @param type $kaina
	 */
	public function deleteServicePrice($serviceId, $galiojaNuo, $galiojaIki, $kaina) {
		$serviceId = mysql::escapeFieldForSQL($serviceId);
		$galiojaNuo = mysql::escapeFieldForSQL($galiojaNuo);
        $galiojaIki = mysql::escapeFieldForSQL($galiojaIki);
		$kaina = mysql::escapeFieldForSQL($kaina);
		
		$query = "  DELETE FROM `{$this->paslaugu_kainos_lentele}`
					WHERE `fk_Paslaugaid_Paslauga`='{$serviceId}' AND `galioja_nuo`='{$galiojaNuo}' AND `galioja_iki`='{$galiojaIki}' AND `kaina_laikotarpiu`='{$kaina}'";
		mysql::query($query);
	}

	/**
	 * Visų paslaugos kainų šalinimas
	 * @param type $serviceId
	 * @param type $clause
	 */
	public function deleteAllServicePrices($serviceId) {
		$serviceId = mysql::escapeFieldForSQL($serviceId);

		$query = "  DELETE FROM `{$this->paslaugu_kainos_lentele}`
					WHERE `fk_Paslaugaid_Paslauga`='{$serviceId}'";
		mysql::query($query);
	}


    /**
     * Paslaugos kainų įtraukimo į užsakymus kiekio radimas
     * @param type $serviceId
     * @param type $validFrom
     * @return type
     */
    public function getPricesCountOfOrderedServices($serviceId, $validFrom) {
        $serviceId = mysql::escapeFieldForSQL($serviceId);
        $validFrom = mysql::escapeFieldForSQL($validFrom);

        $query = "  SELECT COUNT(`{$this->uzsakytos_paslaugos_lentele}`.`fk_Paslaugos_Kainaid_Paslaugos_Kaina`) AS `kiekis`
					FROM `{$this->paslaugu_kainos_lentele}`
						INNER JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->paslaugu_kainos_lentele}`.`fk_Paslaugaid_Paslauga`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_Paslaugos_Kainaid_Paslaugos_Kaina` AND `{$this->paslaugu_kainos_lentele}`.`galioja_nuo`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_Uzsakymas_kodas_paslauga`
					WHERE `{$this->paslaugu_kainos_lentele}`.`fk_Paslaugaid_Paslauga`='{$serviceId}' AND `{$this->paslaugu_kainos_lentele}`.`galioja_nuo`='{$validFrom}'";
        $data = mysql::select($query);

        //
        return $data[0]['kiekis'];
    }

}