<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Exportimport extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Barang_model');
	}

	public function index()
	{
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		$data['title']  = 'Export Import';
		$data['semuabarang'] = $this->Barang_model->getAllDatabarang($tanggalawal,$tanggalakhir);
		$this->load->view('index', $data);
	}

	public function uploaddata()
	{
		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'xlsx|xls';
		$config['file_name']     = 'doc'.time();
		$this->load->library('upload', $config);
		if($this->upload->do_upload('importexcel')){
           $file = $this->upload->data();
           $reader = ReaderEntityFactory::createXLSXReader();

           $reader->open('uploads/' . $file['file_name']);
           foreach($reader->getSheetIterator() as $sheet){
           	  $numRow = 1;
              foreach($sheet->getRowIterator() as $row){
	              	if($numRow > 1){
	              		$databarang = array(
	                        'kode_barang' => $row->getCellAtIndex(1),
	                        'nama_barang' => $row->getCellAtIndex(2),
	                        'jumlah'      => $row->getCellAtIndex(3),
	                        'data_created' => time(),
	                        'data_modified'=> time(),
	              		);

	              		$this->Barang_model->import_data($databarang);
	              	}
              	$numRow++;
              }
              $reader->close();
              unlink('uploads/'.$file['file_name']);
              $this->session->set_flashdata('pesan','import data berhasil');
              redirect('exportimport');
           }
		}else{
			echo "Error :" . $this->upload->display_errors();
		}
	}

	public function mpdf()
	{
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');

		$mpdf = new \Mpdf\Mpdf();
		$databarang = $this->Barang_model->getAllDatabarang($tanggalawal,$tanggalakhir);
		$data = $this->load->view('pdf/mpdf',['semuabarang' => $databarang], TRUE);
		$mpdf->WriteHTML($data);
		$mpdf->Output();
	}

	public function excel()
	{
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		$data['title'] = 'laporan excel';
		$data['semuabarang'] = $this->Barang_model->getAllDatabarang($tanggalawal,$tanggalakhir);
		$this->load->view('excel/excel', $data);
	}

	public function highchart()
	{
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		
		$data['title'] = 'Export Grafik';
		$data['semuabarang'] = $this->Barang_model->getAllDatabarang($tanggalawal,$tanggalakhir);
		$this->load->view('grafik/highchart', $data);
	}

	public function qrcode($kodebarang)
	{
        $qrCode = new Endroid\QrCode\QrCode($kodebarang);
        $qrCode->setLabel($kodebarang);
        $qrCode->setSize(300);
				// Set advanced options
		$qrCode->setWriterByName('png');
				// Directly output the QR code
		header('Content-Type: '.$qrCode->getContentType());
		echo $qrCode->writeString();

		// Save it to a file
		$qrCode->writeFile(__DIR__.'/qrcode.png');

		// Create a response object
		$response = new QrCodeResponse($qrCode);

	}

	public function barcode($kodebarang)
	{
		$generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        file_put_contents('assets/images/barcode/'.$kodebarang.'.jpg', $generator->getBarcode($kodebarang, $generator::TYPE_CODE_128, 3, 50));
        redirect('assets/images/barcode/'.$kodebarang.'.jpg');
	}
}
