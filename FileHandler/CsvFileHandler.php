<?php 

    class CsvFileHandler extends FileHandlerBase{

        public function __construct($directory,$filename){
            parent::__construct($directory,$filename);
        }

        function SaveFile($value){

            parent::CreateDirectory($this->directory);
            $path = $this->directory . "/". $this->filename . ".csv";

            $file = fopen($path, 'w+');

            foreach ($value as $row) {
                fputcsv($file, (array)$row,",");
            }
                            
            fclose($file);
        }

        function ReadFile(){

            $this->CreateDirectory($this->directory);
            $path = $this->directory . "/". $this->filename . ".csv";      
    
            if(file_exists($path)){

                $data = [];

                if (($file = fopen($path, "r")) !== FALSE) 
                {
                    while (($row = fgetcsv($file, 1000, ",")) !== FALSE) 
                    {
                        // var_dump($row);exit();
                        $Can = new Candidato($row[0],$row[1],$row[2],$row[3],$row[4],$row[6],1);
                        $data[] = $Can;
                    }
                }

                fclose($file);

                return $data;

            }else{
                return false;
            }      
    
        }
    }

?>
