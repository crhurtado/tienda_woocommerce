/**
	 * Returns the price in html format.
	 *
	 * @param string $price (default: '')
	 * @return string
	 */
	public function get_price_html( $price = '' ) {

		$display_price         = $this->get_display_price();
		$display_regular_price = $this->get_display_price( $this->get_regular_price() );

		if ( $this->get_price() > 0 ) {

			if ( $this->is_on_sale() && $this->get_regular_price() ) {

				$price .= $this->get_price_html_from_to( $display_regular_price, $display_price );

				$price = apply_filters( 'woocommerce_sale_price_html', $price, $this );

			} else {

				$price .= wc_price( $display_price ) . $this->get_price_suffix();

				$price = apply_filters( 'woocommerce_price_html', $price, $this );

			}

		} elseif ( $this->get_price() === '' ) {

			$price = apply_filters( 'woocommerce_empty_price_html', '', $this );

		} elseif ( $this->get_price() == 0 ) {

			if ( $this->is_on_sale() && $this->get_regular_price() ) {

				$price .= $this->get_price_html_from_to( $display_regular_price, __( 'Free!', 'woocommerce' ) );

				$price = apply_filters( 'woocommerce_free_sale_price_html', $price, $this );

			} else {

				$price = '<span class="amount">' . __( 'Free!', 'woocommerce' ) . '</span>';

				$price = apply_filters( 'woocommerce_free_price_html', $price, $this );

			}
		}

		return apply_filters( 'woocommerce_get_price_html', $price, $this );
	}
	
	/**
	 * Returns the price in html format for single product page.
	 *
	 * @param string $price (default: '')
	 * @return string
	 */

	public function get_price_html_single( $price = '' ) {

		$display_price         = $this->get_display_price();
		$display_regular_price = $this->get_display_price( $this->get_regular_price() );

		if ( $this->get_price() > 0 ) {

			if ( $this->is_on_sale() && $this->get_regular_price() ) {

				$price .= $this->get_price_html_from_to_single( $display_regular_price, $display_price );

				$price = apply_filters( 'woocommerce_sale_price_html', $price, $this );

			} else {

				$price .= wc_price( $display_price ) . $this->get_price_suffix();

				$price = apply_filters( 'woocommerce_price_html', $price, $this );

			}

		} elseif ( $this->get_price() === '' ) {

			$price = apply_filters( 'woocommerce_empty_price_html', '', $this );

		} elseif ( $this->get_price() == 0 ) {

			if ( $this->is_on_sale() && $this->get_regular_price() ) {

				$price .= $this->get_price_html_from_to( $display_regular_price, __( 'Free!', 'woocommerce' ) );

				$price = apply_filters( 'woocommerce_free_sale_price_html', $price, $this );

			} else {

				$price = '<span class="amount">' . __( 'Free!', 'woocommerce' ) . '</span>';

				$price = apply_filters( 'woocommerce_free_price_html', $price, $this );

			}
		}

		return apply_filters( 'woocommerce_get_price_html', $price, $this );
	}
	/**
	 * Functions for getting parts of a price, in html, used by get_price_html.
	 *
	 * @return string
	 */
	public function get_price_html_from_text() {
		$from = '<span class="from">' . _x( 'From:', 'min_price', 'woocommerce' ) . ' </span>';

		return apply_filters( 'woocommerce_get_price_html_from_text', $from, $this );
	}

	/**
	 * Functions for getting parts of a price, in html, used by get_price_html.
	 *
	 * @param  string $from String or float to wrap with 'from' text
	 * @param  mixed $to String or float to wrap with 'to' text
	 * @return string
	 */
	public function get_price_html_from_to( $from, $to ) {
		
		$term_p = get_the_terms( $post->ID, 'product_tag' );
		$tager = array();
		if ( ! empty( $term_p ) && ! is_wp_error( $term_p ) ){
			foreach ( $term_p as $term ) {
				$tager[] = $term->slug;
			}
		}
		/* Check if it is existing in the array to output some value */
		if (in_array ( "c1", $tager ) ) { 
		   $icon_card="azul.png";
		} elseif (in_array ( "c2", $tager )) { $icon_card="roja.png";}
		elseif (in_array ( "c3", $tager )) { $icon_card="verde.png";}
		elseif (in_array ( "c4", $tager )) { $icon_card="verdeclaro.png";}
		elseif (in_array ( "c5", $tager )) { $icon_card="naranja.png";}
		elseif (in_array ( "c6", $tager )) { $icon_card="naranja-azul.png";}
		
		if (in_array ( "mayorista", $tager ) ) { 
		   $mayor=1;
		} else { $mayor=0;}

		if ( $mayor==1 ) {
			$to = $to /3;
			$from = $from/3;
			$price = '<del><span class="deldesc"> <span> Ref. </span>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . $this->get_price_suffix(). ' <small> (c/u)</small></span> <img class="comp" src="http://outlethogar.cl/codex/wp-content/uploads/2017/02/'.$icon_card.'"></del><ins><span class="insdesc"> <span> Mayor: </span>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ). $this->get_price_suffix() . '<small> (c/u)</small></span><img class="prop" src="http://outlethogar.cl/codex/wp-content/uploads/2017/01/icon.png"></ins>';
	}else {
		$price = '<del><span class="deldesc"> <span> Ref. </span>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . $this->get_price_suffix(). ' <small> (c/u)</small></span> <img class="comp" src="http://outlethogar.cl/codex/wp-content/uploads/2017/02/'.$icon_card.'"></del> <ins><span class="insdesc"><span> Detalle: </span>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ). $this->get_price_suffix() . ' <small> (c/u)</small></span><img class="prop" src="http://outlethogar.cl/codex/wp-content/uploads/2017/01/icon.png"></ins>';
	}
		/*
			$price = '<del>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . '</del> <ins>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ) . '</ins>';
		*/

		return apply_filters( 'woocommerce_get_price_html_from_to', $price, $from, $to, $this );
	}
	
	/**
	 * Functions for getting parts of a price to single product page, in html, used by get_price_html_single.
	 *
	 * @param  string $from String or float to wrap with 'from' text
	 * @param  mixed $to String or float to wrap with 'to' text
	 * @return string
	 */
	public function get_price_html_from_to_single( $from, $to ) {
		
		$term_p = get_the_terms( $post->ID, 'product_tag' );
		$tager = array();
		if ( ! empty( $term_p ) && ! is_wp_error( $term_p ) ){
			foreach ( $term_p as $term ) {
				$tager[] = $term->slug;
			}
		}
		/* Check if it is existing in the array to output some value */

		if (in_array ( "c1", $tager ) ) { 
		   $icon_card="azul.png";
		} elseif (in_array ( "c2", $tager )) { $icon_card="roja.png";}
		elseif (in_array ( "c3", $tager )) { $icon_card="verde.png";}
		elseif (in_array ( "c4", $tager )) { $icon_card="verdeclaro.png";}
		elseif (in_array ( "c5", $tager )) { $icon_card="naranja.png";}
		elseif (in_array ( "c6", $tager )) { $icon_card="naranja-azul.png";}
		
		if (in_array ( "mayorista", $tager ) ) { 
		   $mayor=1;
		} else { $mayor=0;}

		if ( $mayor==1 ) {
		$price = '<del><span class="deldesc"> <span> Ref. </span>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . $this->get_price_suffix(). ' <small> (c/u)</small></span> <img class="comp" src="http://outlethogar.cl/codex/wp-content/uploads/2017/02/'.$icon_card.'"></del><ins><span class="insdesc"> <span> Mayor: </span>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ). $this->get_price_suffix() . ' <small> (c/u)</small></span><img class="prop" src="http://outlethogar.cl/codex/wp-content/uploads/2017/01/icon.png"></ins>';
		}else {
		$price = '<del><span class="deldesc"> <span> Ref. </span>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . $this->get_price_suffix(). ' <small> (c/u)</small></span> <img class="comp" src="http://outlethogar.cl/codex/wp-content/uploads/2017/02/'.$icon_card.'"></del> <ins><span class="insdesc"><span> Detalle: </span>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ). $this->get_price_suffix() . ' <small> (c/u)</small></span><img class="prop" src="http://outlethogar.cl/codex/wp-content/uploads/2017/01/icon.png"></ins>';
		}
		/*
			$price = '<del>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . '</del> <ins>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ) . '</ins>';
		*/

		return apply_filters( 'woocommerce_get_price_html_from_to_single', $price, $from, $to, $this );
	}
