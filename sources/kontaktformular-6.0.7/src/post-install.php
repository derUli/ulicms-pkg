<?php
if(!getconfig("contact_form_mail_to"))
     setconfig("contact_form_mail_to", db_escape(getconfig("email")));
