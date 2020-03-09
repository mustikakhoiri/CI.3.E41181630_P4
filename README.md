# CODEIGNITER & REST API

Folder CI.3.E41181630_P4 berisi praktikum CodeIgniter terkait dengan Rest API

**Requirements**
1. Web Server, yaitu xampp versi 7.1 atau yang lebih tinggi
2. CodeIgniter 3.1.11
3. Text Editor, seperti visual studi code, sublime text, dan lain-lain
4. Postman
5. Library Rest Server

**Instalasi**
1. Download dan Install Postman
2. Download CodeIgniter 3.1.11
3. Download Library Rest Server di https://github.com/chriskacerguis/codeigniter-restserver atau https://github.com/ardisaurus/ci-restserver
4. Extract CodeIgniter dan Library Rest Server lalu pindahkan ke dalam localhost komputer (xampp -> htdocs)
5. Buat file controller dan tambahkan code
```use Restserver\Libraries\REST_Controller;```
6. Lalu extend class controller dengan code
```class Kontak extends REST_Controller{}```

**Contoh penggunaan GET dalam REST API**
1. Isikan code berikut dalam file controller

```defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        // memanggil atau load database
        $this->load->database();
    }

    //Menampilkan data kontak dengan menggunakan function get
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('telepon')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('telepon')->result();
        }
        $this->response($kontak, 200);
    }```

2.	Untuk mengecek penggunaannya, dapat dilakukan dengan menggunakan postman



  
