<?php

class shop {

    private $miestas_lentele = '';
    private $parduotuves_lentele = '';
    private $darbuotoju_lentele = '';
    private $uzsakymu_lentele = '';

    public function __construct() {
        $this->miestas_lentele = config::DB_PREFIX . 'Miestas';
        $this->parduotuves_lentele = config::DB_PREFIX . 'Parduotuve';
        $this->darbuotoju_lentele = config::DB_PREFIX . 'Darbuotojas';
        $this->uzsakymu_lentele = config::DB_PREFIX . 'Uzsakymas';
    }

    /**
     * Parduotuves išrinkimas
     * @param type $id
     * @return type
     */
    public function getShop($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "  SELECT *
					FROM {$this->parduotuves_lentele}
					WHERE `id_Parduotuve`='{$id}'";
        $data = mysql::select($query);

        //
        return $data[0];
    }

    /**
     * Parduotuviu sąrašo išrinkimas
     * @param type $limit
     * @param type $offset
     * @return type
     */
    public function getShopList($limit = null, $offset = null) {
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

        $query = "  SELECT *,
						    `{$this->miestas_lentele}`.`pavadinimas` AS `miestas`
					FROM `{$this->parduotuves_lentele}`
						LEFT JOIN `{$this->miestas_lentele}`
							ON `{$this->parduotuves_lentele}`.`fk_Miestasid_Miestas`=`{$this->miestas_lentele}`.`id_Miestas`{$limitOffsetString}";
        $data = mysql::select($query);

        //
        return $data;
    }

    /**
     * Parduotuves darbuotoju sąrašo radimas
     * @param type $serviceId
     */
    public function getShopWorkers($serviceId) {
        $serviceId = mysql::escapeFieldForSQL($serviceId);

        $query = "  SELECT *
					FROM `{$this->darbuotoju_lentele}`
					WHERE `fk_Parduotuveid_Darbuotojas`='{$serviceId}'";
        $data = mysql::select($query);

        //
        return $data;
    }

    public function getCityList($limit = null, $offset = null) {
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

        $query = "  SELECT *
					FROM `{$this->miestas_lentele}`";
        $data = mysql::select($query);

        //
        return $data;
    }

    /**
     * Parduotuviu kiekio radimas
     * @return type
     */
    public function getShopListCount() {
        $query = "  SELECT COUNT(`id_Parduotuve`) AS `kiekis`
					FROM `{$this->parduotuves_lentele}`";
        $data = mysql::select($query);

        //
        return $data[0]['kiekis'];
    }

    /**
     * Parduotuves įrašymas
     * @param type $data
     */
    public function insertShop($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "  INSERT INTO `{$this->parduotuves_lentele}`
								(
									`adresas`,
								    `telefonas`,
								    `e_pastas`,
								    `fk_Miestasid_Miestas`
								)
								VALUES
								(
									'{$data['adresas']}',
								    '{$data['telefonas']}',
								    '{$data['e_pastas']}',
								    '{$data['miestas']}'
								)";
        mysql::query($query);

        //
        return mysql::getLastInsertedId();
    }

    /**
     * Parduotuves atnaujinimas
     * @param type $data
     */
    public function updateShop($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "  UPDATE {$this->parduotuves_lentele}
					SET    `adresas`='{$data['adresas']}',
					        `telefonas`='{$data['telefonas']}',
					        `e_pastas`='{$data['e_pastas']}',
					        `fk_Miestasid_Miestas`='{$data['miestas']}'
					WHERE `id_Parduotuve`='{$data['id']}'";
        mysql::query($query);
    }

    /**
     * Parduotuves šalinimas
     * @param type $id
     */
    public function deleteShop($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "  DELETE FROM {$this->parduotuves_lentele}
					WHERE `id_Parduotuve`='{$id}'";
        mysql::query($query);
    }

    /**
     * Parduotuves miestų kiekio radimas
     * @param type $id
     * @return type
     */
    public function getOrderCountOfShops($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "  SELECT COUNT({$this->uzsakymu_lentele}.`fk_Parduotuveid_Uzsakymas`) AS `kiekis`
					FROM {$this->parduotuves_lentele}
						INNER JOIN {$this->uzsakymu_lentele}
							ON {$this->parduotuves_lentele}.`id_Parduotuve`={$this->uzsakymu_lentele}.`fk_Parduotuveid_Uzsakymas`
					WHERE {$this->parduotuves_lentele}.`id_Parduotuve`='{$id}'";
        $data = mysql::select($query);

        //
        return $data[0]['kiekis'];
    }

    /**
     * Parduotuves darbuotoju įrašymas
     * @param type $serviceId
     * @param type $vardas
     * @param type $pavarde
     */
    public function insertShopWorkers($serviceId, $vardas, $pavarde) {
        $serviceId = mysql::escapeFieldForSQL($serviceId);
        $vardas = mysql::escapeFieldForSQL($vardas);
        $pavarde = mysql::escapeFieldForSQL($pavarde);

        $query = "  INSERT INTO `{$this->darbuotoju_lentele}`
								(
									`fk_Parduotuveid_Darbuotojas`,
									`vardas`,
								    `pavarde`
								)
								VALUES
								(
									'{$serviceId}',
									'{$vardas}',
								    '{$pavarde}'
								)";
        mysql::query($query);
    }

    /**
     * Parduotuves darbuotojo šalinimas
     * @param type $serviceId
     * @param type $vardas
     * @param type $pavarde
     */
    public function deleteShopWorker($serviceId, $vardas, $pavarde) {
        $serviceId = mysql::escapeFieldForSQL($serviceId);
        $vardas = mysql::escapeFieldForSQL($vardas);
        $pavarde = mysql::escapeFieldForSQL($pavarde);

        $query = "  DELETE FROM `{$this->darbuotoju_lentele}`
					WHERE `fk_Parduotuveid_Darbuotojas`='{$serviceId}' AND `vardas`='{$vardas}' AND `pavarde`='{$pavarde}'";
        mysql::query($query);
    }

    /**
     * Visų parduotuves darbuotoju šalinimas pagal id
     * @param type $serviceId
     * @param type $clause
     */
    public function deleteAllShopWorkers($serviceId) {
        $serviceId = mysql::escapeFieldForSQL($serviceId);

        $query = "  DELETE FROM `{$this->darbuotoju_lentele}`
					WHERE `fk_Parduotuveid_Darbuotojas`='{$serviceId}'";
        mysql::query($query);
    }
}