<?php

class manufacturer {

    private $irenginiai_lentele = '';
	private $gamintojas_lentele = '';
	private $modeliai_lentele = '';

	public function __construct() {
        $this->irenginiai_lentele = config::DB_PREFIX . 'Irenginys';
		$this->gamintojas_lentele = config::DB_PREFIX . 'Gamintojas';
		$this->modeliai_lentele = config::DB_PREFIX . 'Modelis';
	}
	
	/**
	 * Gamintojo išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getManufacturer($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "  SELECT *
					FROM {$this->gamintojas_lentele}
					WHERE `id_Gamintojas`='{$id}'";
		$data = mysql::select($query);
		
		//
		return $data[0];
	}
	
	/**
	 * Gamintoju sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getManufacturerList($limit = null, $offset = null) {
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

        $query = "  SELECT `{$this->gamintojas_lentele}`.`id_Gamintojas`,
						   `{$this->gamintojas_lentele}`.`pavadinimas`,
						    `{$this->irenginiai_lentele}`.`tipas`
					FROM `{$this->gamintojas_lentele}`
						LEFT JOIN `{$this->irenginiai_lentele}`
							ON `{$this->gamintojas_lentele}`.`fk_Irenginysid_Irenginys`=`{$this->irenginiai_lentele}`.`id_Irenginys`{$limitOffsetString}";
        $data = mysql::select($query);

		//
		return $data;
	}

    public function getDeviceList($limit = null, $offset = null) {
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
					FROM `{$this->irenginiai_lentele}`";
        $data = mysql::select($query);

        //
        return $data;
    }

	/**
	 * Gamintojo kiekio radimas
	 * @return type
	 */
	public function getManufacturerListCount() {
		$query = "  SELECT COUNT(`id_Gamintojas`) AS `kiekis`
					FROM `{$this->gamintojas_lentele}`";
                    		$data = mysql::select($query);
		
		// 
		return $data[0]['kiekis'];
	}
	
	/**
	 * Gamintojo įrašymas
	 * @param type $data
	 */
	public function insertManufacturer($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);

		$query = "INSERT INTO {$this->gamintojas_lentele}
								(
									`pavadinimas`,
								    `fk_Irenginysid_Irenginys`
								)
								VALUES
								(
									'{$data['pavadinimas']}',
								    '{$data['irenginys']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Gamintojo atnaujinimas
	 * @param type $data
	 */
	public function updateManufacturer($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);

		$query = "  UPDATE {$this->gamintojas_lentele}
					SET    `pavadinimas`='{$data['pavadinimas']}',
					        `fk_Irenginysid_Irenginys`='{$data['irenginys']}'
					WHERE `id_Gamintojas`='{$data['id']}'";
		mysql::query($query);
	}
	
	/**
	 * Gamintojo šalinimas
	 * @param type $id
	 */
	public function deleteManufacturer($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "  DELETE FROM {$this->gamintojas_lentele}
					WHERE `id_Gamintojas`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Gamintojo modelių kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getModelCountOfManufacturer($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "  SELECT COUNT({$this->modeliai_lentele}.`fk_Gamintojasid_Gamintojas_ID`) AS `kiekis`
					FROM {$this->gamintojas_lentele}
						INNER JOIN {$this->modeliai_lentele}
							ON {$this->gamintojas_lentele}.`id_Gamintojas`={$this->modeliai_lentele}.`fk_Gamintojasid_Gamintojas_ID`
					WHERE {$this->gamintojas_lentele}.`id_Gamintojas`='{$id}'";
		$data = mysql::select($query);
		
		//
		return $data[0]['kiekis'];
	}

	
}