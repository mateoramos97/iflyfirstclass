<?php

namespace common\sys\core\blockedEmails;

use common\sys\repository\blockedEmails\BlockedEmailsRepository;

class BlockedEmailsInfoService
{
    private $blocked_emails_repo;
    private function get_blocked_emails_repo()
    {
        if($this->blocked_emails_repo != null)
            return $this->blocked_emails_repo;
        $this->blocked_emails_repo = new BlockedEmailsRepository();
        return $this->blocked_emails_repo;
    }

    public function get_blocked_emails()
    {
        return $this->get_blocked_emails_repo()->get_items();
    }

    public function get_blocked_email($email)
    {
        return $this->get_blocked_emails_repo()->get_item_by_email($email);
    }

    public function get_blocked_email_by_id($id)
    {
        return $this->get_blocked_emails_repo()->get_blocked_email_by_id($id);
    }

    public function BlockedEmailListDataProvider($count)
    {
        return $this->get_blocked_emails_repo()->BlockedEmailListDataProvider($count);
    }
}