String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
var baseUrl = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname.split('/')[1];
var moving = false;
//map.addEventListener("mousedown", initialClick, false);
//map.addEventListener("mousedown", initialClick, false);
var sortingOrder = 'name'; //default sort


function move(e){
  var newX = e.clientX - 10;
  var newY = e.clientY - 10;

  image.style.left = newX + "px";
  image.style.top = newY + "px";
}

  var searchMatch = function (haystack, needle) {
    if (!needle) {
      return true;
    }
    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
  }
 
function initialClick(e) {
  if (moving) {
    document.removeEventListener("mousemove", move);
    moving = !moving;
    return;
  }

  moving = !moving;
  image = this;
  document.addEventListener("mousemove", move, false);
}



function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function format_date(dateobj) {
  var hour = dateobj.getHours().toString();
  var minute = dateobj.getMinutes().toString();
  return hour + ":" + minute;
}
function total_by_month(lst, year) {
  //Returns a list of objects by month/total
  var relobj = {
    '1':0,
    '2':0,
    '3':0,
    '4':0,
    '5':0,
    '6':0,
    '7':0,
    '8':0,
    '9':0,
    '10':0,
    '11':0,
    '12':0
  };

  for (var b = 0; b < lst.length; b++) {
    if (lst[b] != undefined) {
      if(lst[b].date_paid.getFullYear().toString() == year)
        relobj[lst[b].date_paid.getMonth().toString()] += parseFloat(lst[b].amount);
    }
  }

  var arr = Object.keys(relobj).map(function (key) { return relobj[key]; });

  return arr;
}

function getAllUrlParams(url) {
      // get query string from url (optional) or window
      var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
      var obj = {};

      // if query string exists
      if (queryString) {
        queryString = queryString.split('#')[0];
        var arr = queryString.split('&');

        for (var i=0; i<arr.length; i++) {
          // separate the keys and the values
          var a = arr[i].split('=');

          // in case params look like: list[]=thing1&list[]=thing2
          var paramNum = undefined;
          var paramName = a[0].replace(/\[\d*\]/, function(v) {
            paramNum = v.slice(1,-1);
            return '';
          });

          // set parameter value (use 'true' if empty)
          var paramValue = typeof(a[1])==='undefined' ? true : a[1];

          // (optional) keep case consistent
          paramName = paramName.toLowerCase().capitalize();
          paramValue = paramValue.toLowerCase();

          // if parameter name already exists
          if (obj[paramName]) {
            if (typeof obj[paramName] === 'string') {
              obj[paramName] = [obj[paramName]];
            }
            if (typeof paramNum === 'undefined') {
              obj[paramName].push(paramValue);
            }
            else {
              obj[paramName][paramNum] = paramValue;
            }
          }
          else {
            obj[paramName] = paramValue;
          }
        }
      }

      return obj;
    }

function isParam(objekk, variable) {
    if (typeof objekk[variable] === 'undefined') {
        return false;
    }
    else {
      return true;
    }
  }


function previous() {
  window.history.back();
}

function twoDigits(d) {
    if(0 <= d && d < 10) return "0" + d.toString();
    if(-10 < d && d < 0) return "-0" + (-1*d).toString();
    return d.toString();
}
Date.prototype.toMysqlFormat = function() {
    return this.getUTCFullYear() + "-" + twoDigits(1 + this.getUTCMonth()) + "-" + twoDigits(this.getUTCDate()) + " " + twoDigits(this.getUTCHours()) + ":" + twoDigits(this.getUTCMinutes()) + ":" + twoDigits(this.getUTCSeconds());
};
