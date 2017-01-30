/**
	 * Functions for getting parts of a price, in html, used by get_price_html.
	 *
	 * @param  string $from String or float to wrap with 'from' text
	 * @param  mixed $to String or float to wrap with 'to' text
	 * @return string
	 */
	public function get_price_html_from_to( $from, $to ) {
		$meta = get_post_meta( $this->id );
		$mayor = $meta['wccaf_mayorista'][0];
		if ( $mayor==0 ) {
		$price = '<del> <span class="minorista">Minorista: </span>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . $this->get_price_suffix(). '</del> <ins> <span class="mayorista">Mayorista: </span>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ). $this->get_price_suffix() . '</ins>';
	}else {
		$price = '<del> <span class="mayorista">Mayorista: </span>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . $this->get_price_suffix(). '</del> <ins> <span class="minorista">Minorista: </span>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ). $this->get_price_suffix() . '</ins>';
	}
		/*
			$price = '<del>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . '</del> <ins>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ) . '</ins>';
		*/

		return apply_filters( 'woocommerce_get_price_html_from_to', $price, $from, $to, $this );
	}
