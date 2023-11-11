<?php

namespace common\sys\core\blockedEmails;

use common\sys\repository\blockedEmails\BlockedEmailsRepository;

class BlockedEmailsEditService
{
    private $blocked_emails_repo;
    private function get_blocked_emails_repo()
    {
        if($this->blocked_emails_repo != null)
            return $this->blocked_emails_repo;
        $this->blocked_emails_repo = new BlockedEmailsRepository();
        return $this->blocked_emails_repo;
    }

    public function add_item($params)
    {
        return $this->get_blocked_emails_repo()->add_item($params);
    }

    public function update_item($id, $params)
    {
        return $this->get_blocked_emails_repo()->update_item($id, $params);
    }

    public function delete_item($id)
    {
        return $this->get_blocked_emails_repo()->delete_item($id);
    }
}