<?php

	class tags{
		
		public $html;

		public $filter = array( // по этим элементам отсеивается не нужный тег (например, js скрипты)
			1 => ".",
			2 => "-",
			3 => ":",
			4 => "/",
			5 => "\"",
			6 => "'",
			7 => "`",
			8 => "=",
			9 => "&",
			10 => "+",			
		);		

		
		public function getTags(){
				
				$i = -1;		
				while ($i < strlen($this->html)-1){
					$i++;
					
					if (($this->html[$i] == '<') and ($this->html[$i+1] != '/')){ // находим начало тега
						
						$tagObject = '';
						while ($this->html[$i] != '>'){// отсеиваем конец тега
							$i++;
							if (($this->html[$i] == ' ') or ($this->html[$i] == '>')) break;
							$tagObject .= $this->html[$i]; // получаем сам тег
						}
						
						
						// отсеиваем js скрипты
						$j = 0; 
						$d_filter = 0;
						while ($j < count($this->filter)){
							$j++;				
							if (stripos(mb_strtolower($tagObject), mb_strtolower($this->filter[$j])) != '')	$d_filter++;
						}
						
						// собираем теги в массив
						if ($d_filter == 0){
								$z = -1;
								$d = 0;
								while ($z < count($tagArr)){
									$z++;
									if ($tagArr[$z] == $tagObject){
										$d++;
										$tagArrCount[$z]++;
									}
								}
								if ($d == 0){
									$tagArr[count($tagArr)+1] = $tagObject;
									$tagArrCount[count($tagArrCount)+1] = 1;
								}
						}
						
					}
				}
				
				// вывод результата
				echo 'Результат по найденым html тегам:</br>';
				$i = 0;
				while ($i < count($tagArr)){
					$i++;
					echo 'Тег: "' . $tagArr[$i] . '" в количестве: ' . $tagArrCount[$i] . 'шт. </br>';
				}
				
		}		
		
	}

	$val = new tags(); // публикуем класс
	$val->html = file_get_contents('https://www.google.ru/'); // парсер	
	$val->getTags(); // запуск функции


?>
