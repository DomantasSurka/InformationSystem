<?php

class device {

    private $irenginiai_lentele = '';
    private $gamintojai_lentele = '';

    public function __construct() {
        $this->irenginiai_lentele = config::DB_PREFIX . 'Irenginys';
        $this->gamintojai_lentele = config::DB_PREFIX . 'Gamintojas';
    }

    /**
     * Irenginio išrinkimas
     * @param type $id
     * @return type
     */
    public function getDevice($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "  SELECT *
					FROM `{$this->irenginiai_lentele}`
					WHERE `id_Irenginys`='{$id}'";
        $data = mysql::select($query);

        //
        return $data[0];
    }

    /**
     * Ireginiu sąrašo išrinkimas
     * @param type $limit
     * @param type $offset
     * @return type
     */
    public function getDevicesList($limit = null, $offset = null) {
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
					FROM `{$this->irenginiai_lentele}`" . $limitOffsetString;
        $data = mysql::select($query);

        //
        return $data;
    }

    /**
     * Irenginiu kiekio radimas
     * @return type
     */
    public function getDevicesListCount() {
        $query = "  SELECT COUNT(`id_Irenginys`) as `kiekis`
					FROM `{$this->irenginiai_lentele}`";
        $data = mysql::select($query);

        //
        return $data[0]['kiekis'];
    }

    /**
     * Irenginio šalinimas
     * @param type $id
     */
    public function deleteDevice($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "  DELETE FROM `{$this->irenginiai_lentele}`
					WHERE `id_Irenginys`='{$id}'";
        mysql::query($query);
    }

    /**
     * Irenginio atnaujinimas
     * @param type $data
     */
    public function updateDevice($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "  UPDATE `{$this->irenginiai_lentele}`
					SET    `tipas`='{$data['tipas']}'
					WHERE `id_Irenginys`='{$data['id']}'";
        mysql::query($query);
    }

    /**
     * Irenginio įrašymas
     * @param type $data
     */
    public function insertDevice($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "  INSERT INTO `{$this->irenginiai_lentele}`
								(
									`tipas`
								) 
								VALUES
								(
									'{$data['tipas']}'
								)";
        mysql::query($query);
    }

    /**
     * Gamintoju, į kuriuos įtrauktas irenginys, kiekio radimas
     * @param type $id
     * @return type
     */
    public function getManufacturerCountOfDevice($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "  SELECT COUNT({$this->gamintojai_lentele}.`fk_Irenginysid_Irenginys`) AS `kiekis`
					FROM {$this->irenginiai_lentele}
						INNER JOIN {$this->gamintojai_lentele}
							ON {$this->irenginiai_lentele}.`id_Irenginys`={$this->gamintojai_lentele}.`fk_Irenginysid_Irenginys`
					WHERE {$this->irenginiai_lentele}.`id_Irenginys`='{$id}'";
        $data = mysql::select($query);

        //
        return $data[0]['kiekis'];
    }

}