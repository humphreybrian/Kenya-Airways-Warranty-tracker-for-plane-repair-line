<?php
function auth($username, $password, $domain = 'kq_domain_1', $endpoint = 'ldap://10.2.1.236:3268', $dc = 'OU=Kenya Airways,DC=kq,DC=kenya-airways,DC=com') {
  $ldap = @ldap_connect($endpoint);
  if(!$ldap) return false;

  ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

  $bind = @ldap_bind($ldap, "$domain\\$username", $password);
  if(!$bind) return false;

  $result = @ldap_search($ldap, $dc, "(sAMAccountName=$username)");
  if(!$result) return false;

  @ldap_sort($ldap, $result, 'sn');
  $info = @ldap_get_entries($ldap, $result);
  if(!$info) return false;
  if(!isset($info['count']) || $info['count'] !== 1) return false;

  $data = [];

  foreach($info[0] as $key => $value) {
    if(is_numeric($key)) continue;
    if($key === 'count') continue;

    $data[$key] = (array)$value;
    unset($data[$key]['count']);
  }

  return [
    'mail' => $data['mail'][0],
    'displayname' => $data['displayname'][0],
    'samaccountname' => $data['samaccountname'][0],
    'title' => $data['title'][0]
  ];
}
?>

<?php
session_start();
    if(isset($_SESSION['sess_username']) && ($_SESSION['sess_userrole'] == 'user')){
      header('Location: dashboard.php'); //changed from dashboard not the factor
    }else if(isset($_SESSION['sess_username']) && ($_SESSION['sess_userrole'] == 'admin')){
      header('Location: manageusers.php');

    }
?>
<?php 
if (isset($_POST['btnLogin'])) {

    if(empty($_POST['username']) || empty($_POST['password'])) { 
          header('Location: index.php?err=3');
      } else {
          $info = auth($_POST['username'], $_POST['password']);

          if(!$info) {
              header('Location: index.php?err=1');
          }
            else{
                session_regenerate_id();
                $_SESSION['mail'] = $info['mail'];
                $_SESSION['displayname'] = $info['displayname'];
                $_SESSION['sess_username'] =  $info['samaccountname'];
                //$_SESSION['sess_userrole'] = $info['title'];//role
                $_SESSION['sess_userrole'] = $info['mail'];

                session_write_close();

                if( $_SESSION['sess_userrole'] == "brian.ochieng@kenya-airways.com" ||  $_SESSION['sess_userrole'] == "emmanuel.magak@kenya-airways.com"){
                  header('Location: manageusers.php');
                }else{
                  header('Location: dashboard.php');
                }
            }
          }

    }
        
?>