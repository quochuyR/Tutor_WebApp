<?php
namespace Model;

class Tutor_Model
{
    public $_userId;
    public $_introduction;
    public $_currentAddress;
    public $_college;
    public $_currentJob;
    public $_teachingForm;
    public $_teachingArea;
    public $_linkFacebook;
    public $_linkTwitter;
    
    public function __construct(
        $userId,
        $introduction,
        $currentAddress,
        $college,
        $currentJob,
        $teachingForm,
        $teachingArea,
        $linkFacebook,
        $linkTwitter
    ) {
        $this->_userId = $userId;
        $this->_introduction = $introduction;
        $this->_currentAddress = $currentAddress;
        $this->_college = $college;
        $this->_currentJob = $currentJob;
        $this->_teachingForm = $teachingForm;
        $this->_teachingArea = $teachingArea;
        $this->_linkFacebook = $linkFacebook;
        $this->_linkTwitter = $linkTwitter;
    }
}
