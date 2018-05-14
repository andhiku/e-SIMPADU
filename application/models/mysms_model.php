<?php

Class Mysms_Model extends Model {

    //=================================================================
    // HOME
    //=================================================================
    function Mysms_model() {
        parent::Model();
    }

    //=================================================================
    // PHONEBOOK GROUP
    //=================================================================	
    function getCallGroup() {
        $sql = "select * from pbk_groups";
        $hasil = $this->db->query($sql);
        return $hasil;
    }

    function getCallGroupbyID($callGroupId) {
        $sql = "select * from pbk_groups where ID='$callGroupId'";
        $hasil = $this->db->query($sql);
        $data = array();
        $data['id'] = $hasil->row('ID');
        $data['title'] = $hasil->row('Name');
        return $data;
    }

    function insertCallGroup() {
        $data = array('Name' => $this->input->post('call_group_title'));
        $this->db->insert('pbk_groups', $data);
    }

    function updateCallGroup() {
        $onDemandId = $this->input->post('call_group_id');
        $data = array('Name' => $this->input->post('call_group_title'));
        $this->db->where('ID', $onDemandId);
        $this->db->update('pbk_groups', $data);
    }

    function delCallGroupbyID($onDemandId) {
        $this->db->delete('pbk_groups', array('ID' => $onDemandId));
    }

    //=================================================================
    // PHONEBOOK
    //=================================================================	  	
    function selectPbkGroups() {
        $sql = "select * from pbk_groups";
        $total = $this->db->query($sql);
        $return = array();
        foreach ($total->result() as $tmp) :
            $return["$tmp->ID"] = $tmp->Name;
        endforeach;
        return $return;
    }

    function getPhonebook($option = NULL, $id = NULL, $limit = NULL, $offset = NULL) {
        switch ($option) {
            case 'all':
                $sql = "SELECT a.pbkID, a.Name, a.Number, b.Name as GroupName FROM `pbk` a JOIN `pbk_groups` b ON a.GroupID = b.ID";
                break;
            case 'bynumber':
                $sql = "select Name from pbk where Number='" . $id . "'";
                break;
            case 'group':
                $sql = "select * from pbk_groups order by Name";
                break;
        }
        $hasil = $this->db->query($sql);
        return $hasil;
    }

    function getPhonebookbyID($callGroupId) {
        $sql = "SELECT a.pbkID,a.GroupID, a.Name, a.Number, b.Name as GroupName FROM `pbk` a JOIN `pbk_groups` b ON a.GroupID = b.ID where a.pbkID='$callGroupId'";
        $hasil = $this->db->query($sql);
        $data = array();
        $data['id'] = $hasil->row('pbkID');
        $data['name'] = $hasil->row('Name');
        $data['number'] = $hasil->row('Number');
        $data['group'] = $hasil->row('GroupName');
        $data['groupid'] = $hasil->row('GroupID');
        return $data;
    }

    function insertPhonebook() {
        $data = array(
            'Name' => $this->input->post('person_name'),
            'Number' => $this->input->post('phone_number'),
            'GroupID' => $this->input->post('phone_group')
        );
        $this->db->insert('pbk', $data);
    }

    function updatePhonebook() {
        $onDemandId = $this->input->post('phonebookid');
        $data = array(
            'Name' => $this->input->post('person_name'),
            'Number' => $this->input->post('phone_number'),
            'GroupID' => $this->input->post('phone_group')
        );
        $this->db->where('pbkID', $onDemandId);
        $this->db->update('pbk', $data);
    }

    function delPhonebookbyID($onDemandId) {
        $this->db->delete('pbk', array('pbkID' => $onDemandId));
    }

    //=================================================================
    // INBOX SMS
    //=================================================================		
    function getInbox($option = NULL, $limit = NULL, $offset = NULL, $dateAwal = NULL, $dateAkhir = NULL) {
        switch ($option) {
            case 'all':
                $sql = "select * from inbox order by ReceivingDateTime DESC";
                break;
            case 'paginate':
                $sql = "select * from inbox order by ReceivingDateTime DESC limit " . $limit . " offset " . $offset . "";
                break;
            case 'last':
                $sql = "select * from inbox order by ID DESC limit 1";
                break;
            case 'filter':
                $sql = "select * from inbox where ReceivingDateTime>='$dateAwal' and ReceivingDateTime<='$dateAkhir' order by ReceivingDateTime DESC limit " . $limit . " offset " . $offset . "";
                break;
        }
        return $this->db->query($sql);
    }

    function delInbox() {
        $this->db->delete('inbox', array('ID' => $this->input->post('id')));
    }

    //=================================================================
    // SEND SMS
    //=================================================================
    function sendMessage($dest, $date, $message) {
        $data = array(
            'InsertIntoDB' => date('Y-m-d H:i:s'),
            'SendingDateTime' => $date,
            'DestinationNumber' => $dest,
            'Coding' => 'Default_No_Compression',
            'TextDecoded' => $message,
            'CreatorId' => ' ',
        );
        $this->db->insert('outbox', $data);
    }

    function insertOutbox($dest, $date, $message, $jumlah) {
        $data = array(
            'InsertIntoDB' => date('Y-m-d H:i:s'),
            'SendingDateTime' => $date,
            'DestinationNumber' => $dest,
            'MultiPart' => 'true',
            'UDH' => '050003D3' . $jumlah . '01',
            'Coding' => 'Default_No_Compression',
            'TextDecoded' => $message,
            'CreatorId' => 'daud'
        );
        $this->db->insert('outbox', $data);
    }

    function getLastOutboxID() {
        $sql = "select max(ID) as value from outbox";
        return $this->db->query($sql);
    }

    function insertOutboxMultipart($outboxid, $message, $pos, $jumlah) {
        $code = $pos + 1;
        $data = array(
            'ID' => $outboxid,
            'UDH' => '050003D3' . $jumlah . '0' . $code,
            'SequencePosition' => $code,
            'Coding' => 'Default_No_Compression',
            'TextDecoded' => $message,
        );
        $this->db->insert('outbox_multipart', $data);
    }

    //=================================================================
    // OUTBOX SMS
    //=================================================================		
    function getOutbox($option = NULL, $limit = NULL, $offset = NULL) {
        switch ($option) {
            case 'all':
                $sql = "select * from outbox order by SendingDateTime DESC";
                break;

            case 'paginate':
                $sql = "select * from outbox order by SendingDateTime DESC limit " . $limit . " offset " . $offset . "";
                break;
        }
        return $this->db->query($sql);
    }

    //=================================================================
    // SENT ITEMS
    //=================================================================	
    function getSentItems($option = NULL, $limit = NULL, $offset = NULL, $dateAwal = NULL, $dateAkhir = NULL) {
        switch ($option) {
            case 'all':
                $sql = "select * from sentitems group by ID order by SendingDateTime DESC";
                break;
            case 'paginate':
                $sql = "select * from sentitems group by ID order by SendingDateTime DESC limit " . $limit . " offset " . $offset . "";
                break;
            case 'filter':
                $sql = "select * from sentitems where SendingDateTime>='$dateAwal' and SendingDateTime<='$dateAkhir' order by SendingDateTime DESC limit " . $limit . " offset " . $offset . "";
                break;
        }
        return $this->db->query($sql);
    }

    function delSentItems() {
        $this->db->delete('sentitems', array('ID' => $this->input->post('id')));
    }

    //=================================================================
    // UBAH FORMAT TANGGAL AGAR SESUAI DENGAN FORMAT DI DATABASE MYSQL
    //=================================================================	
    function _revDate($date) {
        $theDate = explode('/', $date);
        $array = array($theDate[2], $theDate[1], $theDate[0]);
        $return = implode('-', $array);
        return $return;
    }
    
    
    //=================================================================
    // JIKA DIPERLUKAN
    //=================================================================
    
    //protected $table = 'schedule';
    //protected $perPage = 5;
    
    public function getValidationRules()
    {
        return [
            [
            'field' => 'no_hp',
            'label' => 'Nomor HP',
            'rules' => 'trim|required|numeric|max_length[15]'
            ],
            [
            'field' => 'waktu',
            'label' => 'Waktu',
            'rules' => 'trim|required'
            ],
            [
            'field' => 'pesan',
            'label' => 'Pesan',
            'rules' => 'trim|required|max_length[160]'
            ]
        ];
    }

    public function getDefaultValues()
    {
        return [
            'no_hp' => '',
            'waktu' => '',
            'pesan' => ''
        ];
    }

    public function insert($data)
    {
        $data->no_hp = $this->formatPhoneNumber($data->no_hp);
        $data->tanggal = $this->parseTanggal($data->waktu);
        $data->jam = $this->parseJam($data->waktu);

        // Data waktu tidak perlu disimpan. Kita sudah memparse data
        // waktu menjadi tanggal dan jam.
        unset($data->waktu);

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    private function parseTanggal($waktu)
    {
        return substr($waktu, 0, 10);
    }

    private function parseJam($waktu)
    {
        return substr($waktu, -5, 5);
    }

    public function paginate($page)
    {
        $offset = $this->calcRealOffset($page);
        $schedule = $this->db->select(
                                'ID,
                                 tanggal,
                                 jam,
                                 no_hp,
                                 pesan'
                              )
                             ->order_by('ID', 'desc')
                             ->limit($this->perPage, $offset)
                             ->get($this->table)
                             ->result();
        $schedule = $this->prepDestinationName($schedule);
        return $schedule;
    }

    private function prepDestinationName($schedule)
    {
        foreach($schedule as $row) {
            $noHP = $row->no_hp;
            $found = $this->getContactName($noHP);
            if ($found) {
                $nama = $found->Name;
                $row->no_hp = "<span>$nama</span>$noHP";
            } else {
                $row->no_hp = $noHP;
            }
        }
        return $schedule;
    }

    /*
    |-----------------------------------------------------------------
    | Cek apakah ada sms yang sudah terjadwal untuk waktu saat ini?
    | Jika ada, kirimkan.
    |-----------------------------------------------------------------
    */
    public function runDaemon()
    {
        $tanggalSekarang = date('Y-m-d');
        $jamSekarang = date('H:i');

        $schedule = $this->getSchedule(
            $tanggalSekarang,
            $jamSekarang
        );

        if ($schedule) {
            return $this->sendSms($schedule);
        }
    }

    private function getSchedule($tanggal, $jam)
    {
        return $this->db->where('tanggal', $tanggal)
                        ->where('jam', $jam)
                        ->where('status', 'belum')
                        ->get($this->table)
                        ->row();
    }

    private function sendSms($schedule)
    {
        $data = (object) $this->prepData($schedule);
        $this->db->insert('outbox', $data);
        $this->changeStatus($data->ID);
    }

    private function prepData($schedule)
    {
        $data = [
            'ID'                => $schedule->ID,
            'DestinationNumber' => $schedule->no_hp,
            'TextDecoded'       => $schedule->pesan
        ];

        return $data;
    }

    private function changeStatus($ID)
    {
        $data = ['status' => 'terkirim'];
        $this->db->where('ID', $ID)->update('schedule', $data);
    }
    
    function waktu_sms($id) {
        $dt = date('Y-m-d h:i:s', time());
        $sql_db = "update layanan_tb set lastsms = '$dt' where id='$id'";
        return mysql_query($sql_db);
    }

}

?>
