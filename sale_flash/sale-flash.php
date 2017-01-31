if ($product->is_on_sale() && $product->product_type == 'variable') : 

			$available_variations = $product->get_available_variations();								
			$maximumper = 0;
			$maxahorro=0;
			for ($i = 0; $i < count($available_variations); ++$i) {
				$variation_id=$available_variations[$i]['variation_id'];
				$variable_product1= new WC_Product_Variation( $variation_id );
				$regular_price = $variable_product1 ->regular_price;
				$sale_price = $variable_product1 ->sale_price;
				$ahorro= round(($regular_price-$sale_price),1);
					if($ahorro > $maxahorro){
						$maxahorro = $ahorro;
					}
				$percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100)) ;
					if ($percentage > $maximumper) {
						$maximumper = $percentage;
					}
				}
				if ($maxahorro >= 5000) {
					if ($maxahorro>=10000){
							?>
							<div class="bubblered">
								<div class="inside">
									<div class="inside-text">
							<?php
						}
						else{ ?>
							<div class="bubble">
								<div class="inside">
									<div class="inside-text">
							<?php
						}
					echo "Ahorra";
					echo "<br />";
					echo $price . sprintf( __('%s', 'woocommerce' ), '$'. number_format($maxahorro, 0, ',', '.') );					
				}else {
					if ($maximumper>=20){
							?>
							<div class="bubblered">
								<div class="inside">
									<div class="inside-text">
							<?php
						}
						else{ ?>
							<div class="bubble">
								<div class="inside">
									<div class="inside-text">
							<?php
						}
				echo $price . sprintf( __('%s', 'woocommerce' ), $maximumper . '%' );
				echo "<br />";
				echo "Dcto";
				} ?></div>
            </div>
     </div><!-- end callout -->

<?php elseif($product->is_on_sale() && $product->product_type == 'simple') : 

				$ahorro= round(($product->regular_price - $product->sale_price),1);
				$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
				if ($ahorro >= 5000) {
						if ($ahorro>=10000){
							?>
							<div class="bubblered">
								<div class="inside">
									<div class="inside-text">
							<?php
						}
						else{ ?>
							<div class="bubble">
								<div class="inside">
									<div class="inside-text">
							<?php
						}
					echo "Ahorra";
					echo "<br />";				
					echo $price . sprintf( __('%s', 'woocommerce' ), '$'. number_format($ahorro, 0, ',', '.') );
				}else {
					if ($percentage>=20){
							?>
							<div class="bubblered">
								<div class="inside">
									<div class="inside-text">
							<?php
						}
						else{ ?>
							<div class="bubble">
								<div class="inside">
									<div class="inside-text">
							<?php
						}
				echo $price . sprintf( __('%s', 'woocommerce' ), $percentage . '%' );
				echo "<br />";
				echo "Dcto";
				} ?></div>
	           </div>
	    </div><!-- end bubble -->

<?php endif; ?>
