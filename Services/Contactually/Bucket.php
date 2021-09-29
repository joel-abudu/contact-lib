<?php
class Services_Contactually_Bucket extends Services_Contactually_Base
{
    public $id = '';
    public $bucket_id = '';
    public $name = '';
    public $sync_to_crm = '';
    public $share_with_team = '';
    public $team_bucket_id = '';
    public $num_days_to_followup = '';
    public $num_days_to_respond = '';
    protected $_show_uri = 'https:
    protected $_resource = 'bucket';
    protected $_create_uri = 'https:
    protected $_delete_uri = 'https:
    public function delete($id = 0)
    {
        $this->delete = str_replace('<id>', $id, $this->_delete_uri);
        $json = $this->client->delete("{$this->delete}", array('id' => $id));
        return (200 == $this->client->status) ? true : false;
    }
}
