<?php //-->

class Mpdf_model extends MY_Model {

    /* Constants
    -------------------------------*/

    /* Public Properties
    -------------------------------*/

    /* Protected Properties
    -------------------------------*/
    protected $_pdf = NULL;
    protected $_title = NULL;
    protected $_html = NULL;

    /* Private Properties
    -------------------------------*/

    /* Public Properties
    -------------------------------*/

    /* Constructor
    -------------------------------*/
    public function __construct() {

        parent::__construct();

        $this->_pdf = $this->pdf->load();
    }

    /* Public Function
    -------------------------------*/
    /**
     * Set pdf name|title
     * 
     * @param string
     * @return this
     */
    public function setTitle($title) {
        
        $this->_pdf->SetTitle($title);
        $this->_title = $title;

        return $this;
    }

    /**
     * Set html to convert in pdf
     * 
     * @param html|string
     * @return this
     */
    public function setHtml($html) {
        $this->_html = $html;
        $this->_pdf->WriteHTML($html);

        return $this;
    }

    /**
     * Print the pdf
     * 
     * @return this
     */
    public function show() {
        
        $this->_pdf->Output($this->_title.'.pdf', 'I');
    }

    /**
     * Direct download the converted pdf
     * 
     * @return this
     */
    public function download() {
        
        header('Set-Cookie: fileDownload=true; path=/');
            
        $this->_pdf->Output($this->_title.'.pdf', 'D');
    }
    
    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
   
}