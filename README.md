     protected function save() 
     {
          // insert one row
          $tafel 			= $_SESSION['bestellingen']['tafelnummer'];
          $reservering_id	= $_SESSION['bestellingen']['reserveringsnummer'];
          $datum 			= date("Y-m-d");
          $tijd 			= date("H:i:s");
          $menuitemcode 		= $_GET['item'];
          $aMenuitem 		= $this->getMenuitem($menuitemcode);
          $aantal 			= 1;
          $prijs 			= $aMenuitem['prijs'];
          
          $bestellingen = "SELECT * FROM bestelling WHERE reservering_id = $reservering_id";          
          $isSelected = false;

          foreach($this->connection->query($bestellingen) as $row) {
               if($row['menuitemcode'] == $menuitemcode) {
                    $isSelected = true;
               }
          }

          if($isSelected) {
               $query = "SELECT aantal FROM bestelling WHERE reservering_id = $reservering_id AND menuitemcode = '$menuitemcode'";          
               foreach($this->connection->query($query) as $row) {
                    $aantalProduct = $row['aantal'];
               }

               $sql = "UPDATE bestelling SET aantal = $aantalProduct + 1 WHERE reservering_id = $reservering_id AND menuitemcode = '$menuitemcode'";
          } else {
               $sql = "INSERT INTO bestelling 
               (reservering_id, tafel, datum, tijd, menuitemcode, aantal, prijs) 
               VALUES ($reservering_id, $tafel, '$datum', '$tijd', '$menuitemcode', $aantal, $prijs)";
          }
          
          if (!($this->connection->query($sql) == true))
          {    print $sql . " Mislukt"; die;
          }
     }
