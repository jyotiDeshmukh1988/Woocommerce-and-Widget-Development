<?php
// ********* modifying the archive product file using Hooks ******** //

remove_action("woocommerce_sidebar","woocommerce_get_sidebar");

// add container and row div class
function open_container_row_div_classes(){
	echo "<div class='container owt-container mt-4'><div class='row owt-row'>";
}
add_action("woocommerce_before_main_content","open_container_row_div_classes",5);

function close_container_row_div_classes(){
	echo "</div></div>";
}
add_action("woocommerce_after_main_content","close_container_row_div_classes",5);

add_action("template_redirect","load_template_layout");

function load_template_layout()
	{
		if(is_shop()) // true
		{
			// col-sm-4 => sidebar
			// col-sm-8 => product grid
			/* creating sidebar */
			// <div class="col-sm-4"> sidebar </div>

			add_action("woocommerce_before_main_content","open_sidebar_column_grid",6);

			function open_sidebar_column_grid(){
				echo "<div class='col-sm-4'>";
			}

			add_action("woocommerce_before_main_content","woocommerce_get_sidebar",7);

			add_action("woocommerce_before_main_content","close_sidebar_column_grid",8);

			function close_sidebar_column_grid(){
				echo "</div>";
			}

			/* creating product grid */
			// <div class="col-sm-8"> product grid </div>

			add_action("woocommerce_before_main_content","open_product_column_grid",9);

			function open_product_column_grid(){
				echo "<div class='col-sm-8'>";
			}

			add_action("woocommerce_before_main_content","close_product_column_grid",10);

			function close_product_column_grid(){
				echo "</div>";
			}
		}
	}
	
/* remove the shop title */
add_filter("woocommerce_show_page_title","toggle_page_title");
function toggle_page_title($val){
	$val = false;
	return $val;
}	

/* add product short description after the product title */
//add_action("woocommerce_after_shop_loop_item_title","the_excerpt");

// removing elements from the archive product.php file
// remove breadcrumb
remove_action("woocommerce_before_main_content","woocommerce_breadcrumb",20);
// remove product count showing results
remove_action("woocommerce_before_shop_loop","woocommerce_result_count",20);
// remove product sorting
remove_action("woocommerce_before_shop_loop","woocommerce_catalog_ordering",30);