<?php
if ( ! class_exists( 'WEPN_Install' ) ) {

    class WEPN_Install {
        public function __construct() {
            $this->includes();
        }


        private function includes() {

            include_once ( "admin/class-wepn-options.php" );
        }
    }
}

return new WEPN_Install();