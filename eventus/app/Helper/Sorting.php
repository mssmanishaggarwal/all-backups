<?php  

	class Sorting
	{				
		var $ERROR = "";		
		
		function Sorting($DefaultOrderName,$SortingArr,$do_order="",$OrderByID=0,$OrderType="ASC")
		{	
			$OrderTypePreserve = '';
			if(!empty($OrderByID))
			{						
				$OrderType=$OrderType=="ASC"?"DESC":"ASC";								 
				$OrderByName=$SortingArr[$OrderByID];						
				$OrderBySql ="$OrderByName";
				
				$OrderTypePreserve=$OrderType=="ASC"?"DESC":"ASC";
				$OrderLink="/OrderByID/$OrderByID/OrderType/$OrderTypePreserve";
			}
			else
			{
				$OrderBySql ="$DefaultOrderName";
				$OrderType=$OrderType=="ASC"?"DESC":"ASC";
				$OrderLink="/OrderByID/$OrderByID/OrderType/$OrderTypePreserve";
			}							
			
			$DisplaySortingImage=array();
			foreach($SortingArr as $key =>$val)
			{
				$SortingImage="";				
				if($OrderByID==$key)
				{											
					if($OrderType=="ASC") 
						$SortingImage="<span class='fa fa-angle-down fa-fw fa-1h'></span>";
					else if($OrderType=="DESC")
						$SortingImage="<span class='fa fa-angle-up fa-fw fa-1h'></span>";
				}									
				$DisplaySortingImage[$key]=$SortingImage;				
			}	
			
			$return_arr['OrderBy']=$OrderBySql;
			$return_arr['OrderLink']=$OrderLink;
			$return_arr['OrderType']=$OrderType;
			$return_arr['DisplaySortingImage']=$DisplaySortingImage;		
			
			return $return_arr;							
		}				
				
	}	
