<?
# RESTful API - not to be confused with AJAX stuff
class BbApi_v1 extends AbstractBbApi {
  function test() {
    return bam_get_products();
  }
}

abstract class AbstractBbApi {
  static function _method() {
    $headers = apache_request_headers();
    if (!empty($headers['X-HTTP-Method-Override'])) {
      return strtolower($headers['X-HTTP-Method-Override']);
    } else if (!empty($_REQUEST['_method'])) {
      return strtolower(trim($_REQUEST['_method']));
    } else {
      return strtolower($_SERVER['REQUEST_METHOD']);
    }
  }

  function _assertLoggedIn() {
    if (!is_user_logged_in()) {
      wp_redirect(wp_login_url($_SERVER['REQUEST_URI']));
      exit;
    }
  }

  function _isAdmin() {
    return bam_current_user_is_admin();
  }

  function _assertIsAdmin() {
    if (!$this->_isAdmin()) {
      wp_redirect(wp_login_url($_SERVER['REQUEST_URI']));
      exit;
    }
  }

  function _isGet() {
    return self::_method() === 'get';
  }

  function _isPost() {
    return self::_method() === 'post';
  }

  function _isPut() {
    return self::_method() === 'put';
  }

  function _isDelete() {
    return self::_method() === 'delete';
  }
}

add_filter('rewrite_rules_array', 'bb_rewrite_rules_array');
add_filter('query_vars', 'bb_query_vars');
add_action(constant('WP_DEBUG') || constant('BB_DEBUG') ? 'wp_loaded' : 'bb_activated', 'bb_flush_rewrite_rules');
add_action('parse_request', 'bb_parse_request');

// e.g., bb/1/profiles/:id
define('BB_API_REWRITE_RULE', '(bb)/(\d)/([a-z]+)(/.*?)?(.json)?$');

function bb_rewrite_rules_array($rules) {
  return array(
    BB_API_REWRITE_RULE => 'index.php?_bb=$matches[3]&_v=$matches[2]&_args=$matches[4]'
  ) + $rules;
}

function bb_query_vars($vars) {
  $vars[] = '_bb';
  $vars[] = '_v';
  $vars[] = '_args';
  return $vars;
}

function bb_flush_rewrite_rules() {
  $rules = get_option( 'rewrite_rules' );
  if (!isset($rules[BB_API_REWRITE_RULE])) {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
  }
}

function bb_parse_request($wp) {
  if (isset($wp->query_vars['_bb'])) {    
    $class = "BbApi_v{$wp->query_vars['_v']}";
    if (!class_exists($class)) {
      return;
    }
    $api = new $class();
    $fx = array($api, $wp->query_vars['_bb']);
    if (is_callable($fx)) {
      $result = call_user_func_array($fx, array_filter(explode('/', $wp->query_vars['_args'])));
      header('Content-Type: application/json');
      echo json_encode($result);
      exit(0);
    }  
  }
}