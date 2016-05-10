<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Pagenation extends Model {
	
	public static function getGroupPagination($total_pages,$page,$difflimit=10){

			// Initial page num setup	

	$limit = $difflimit; 

	//echo $page;

	$stages = 4;

	

	if($page){		

		$start = ($page - 1) * $limit; 

	}else{

		$page = 1;

		$start = 0;	

		}

	// Initial page num setup

	if ($page == 0){$page = 1;}

	$prev = $page - 1;	

	$next = $page + 1;							

	$lastpage = ceil($total_pages/$limit);		

	$LastPagem1 = $lastpage - 1;					

	

	

	$paginate = '';

	if($lastpage > 1)

	{	

	

		$paginate .= "<div class='pagination'>";

		// Previous

		if ($page > 1){

			$paginate.= "<a href='javascript:void(0);' onclick='funcPagenation($prev,$limit)'> <span class='fa fa-angle-double-left'></span> Prev</a> ";

		}else{

			$paginate.= "<span class='disabled'><span class='fa fa-angle-double-left'></span> Prev</span> ";	}

			



		

		// Pages	

		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up

		{	

			for ($counter = 1; $counter <= $lastpage; $counter++)

			{

				if ($counter == $page){

					$paginate.= " <span class='current'>$counter</span> ";

				}else{

					$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation($counter,$limit)'>$counter</a> ";}					

			}

		}

		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?

		{

			// Beginning only hide later pages

			if($page < 1 + ($stages * 2))		

			{

				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)

				{

					if ($counter == $page){

						$paginate.= " <span class='current'>$counter</span>";

					}else{

						$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation($counter,$limit)'>$counter</a> ";}					

				}

				$paginate.= "...";

				$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation($LastPagem1,$limit)'>$LastPagem1</a> ";

				$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation($lastpage,$limit)'>$lastpage</a> ";		

			}

			// Middle hide some front and some back

			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))

			{

				$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation(1,$limit)'>1</a> ";

				$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation(2,$limit)'>2</a>" ;

				$paginate.= "...";

				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)

				{

					if ($counter == $page){

						$paginate.= " <span class='current'>$counter</span> ";

					}else{

						$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation($counter)'>$counter</a> ";}					

				}

				$paginate.= "...";

				$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation($LastPagem1,$limit)'>$LastPagem1</a> ";

				$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation($lastpage,$limit)'>$lastpage</a> ";		

			}

			// End only hide early pages

			else

			{

				$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation(1)'>1</a> ";

				$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation(2)'>2</a> ";

				$paginate.= "...";

				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)

				{

					if ($counter == $page){

						$paginate.= " <span class='current'>$counter</span> ";

					}else{

						$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation($counter,$limit)'>$counter</a> ";}					

				}

			}

		}

					

				// Next

		if ($page < $counter - 1){ 

			$paginate.= " <a href='javascript:void(0);' onclick='funcPagenation($next,$limit)'>Next <span class='fa fa-angle-double-right'></span></a>";

		}else{

			$paginate.= " <span class='disabled'>Next <span class='fa fa-angle-double-right'></span></span>";

			}

			

		$paginate.= "</div>";		

	

	

	}else{

		

		$paginate.= "<div class='pagination'><strong>Total Records:</strong> $total_pages</div>";	

	}



 return $paginate;

 }



	   

	}//END CLASS

?>