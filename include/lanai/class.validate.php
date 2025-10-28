<?
class Validation {
		function email_validate($email) {
			if (!preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/",  $email)) {
				$result=false;
			} else {
				$result=true;
			}
			return $result;
		}

function checkMail($email)
{
	if(ereg("^[a-zA-Z0-9_\.]+@[a-zA-Z0-9\-]+[\.a-zA-Z0-9]+$", $email))
	{
		return 0;
	}else {
		return 1;
	}
}

function checkAscii($ascii)
{
	if(ereg("^[a-zA-Z0-9 \.\,\+\!\@\#\$\%\^\&\*\(\)\~\/]+$", $ascii))
	{
		return 0;
	}else {
		return 1;
	}
}

function checkAlpha($alpha)
{
	if(ereg("^[a-zA-Z ]+$", $alpha))
	{
		return 0;
	}else {
		return 1;
	}
}

function checkAlphaNum ($alphanum)
{
	if(ereg("^[0-9a-zA-Z ]+$", $alphanum))
	{   if (ereg("[^0-9]+", $alphanum))
		    return 0;
		else
		    return 1;
	}else {
		return 1;
	}
}

function checkLength($str, $length)
{
	if(strlen($str) > $length)
	{
		return -1;
	}
	
	return 0;
}

function checkNumeric($num)
{
	if(ereg("^[0-9]+$", $num))
	{
		return 0;
	}else {
		return 1;
	}
}

function checkDigit($digit)
{
	if(ereg("^[0-9]+$", $digit))
	{
		return 0;
	}else {
		return 1;
	}
}

function checkDns($dns)
{
	if(eregi("^[a-z0-9\+\.\-]+[a-z]+$", $dns))
	{
		return 0;
	}else {
		return 1;
	}
}

function getDatetime()
{
	return date("Y-m-d H:i:s");
}

function getDateo()
{
	return date("Y-m-d");
}

function onlinenicValidateDomain($domain)
{
	if(strlen($domain) > 63)
	{
		return 1;
	}
	if(ereg("^[a-z0-9][a-z0-9\-]+[a-z0-9]$", $domain))
	{
		return 0;
	}else {
		return 1;
	}
}


}
?>