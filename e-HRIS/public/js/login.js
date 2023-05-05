$(document ).ready(function() {

  var tsrc = '';
  var tdst = '';
  tsrc = 'http://192.168.11.64:8000/';
  tdst = 'http://192.168.11.64:8000/';
  onelogin = new OneLogin(_token, tsrc, tdst);
  //onelogin.login();

});

var  _token = $('meta[name="csrf-token"]').attr('content');

var onelogin;

