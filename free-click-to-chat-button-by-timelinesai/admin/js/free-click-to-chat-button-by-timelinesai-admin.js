(function ($) {

  function collectConfig() {
    var widgetConfig = {
      type : $('.widget-type input:checked').val(),
      phone : $('.widget-phone input').val(),
      email : $('.widget-email input').val(),
      totalPages : $('.widget-total input').val(),
      blogTags : $('.widget-tags input').val(),
    }
    return widgetConfig;
  }
  'use strict';
  $(window).load(function () {
    $('.' + $('.widget-type input:checked').val()).addClass('display')
    $('.widget-type label').on('click',function(){
      $('.ww-extended').removeClass('display')
      $('.ww-standard').removeClass('display')
      $('.' + $('.widget-type input:checked').val()).addClass('display')
    })

    $('#free-click-to-chat-button-by-timelinesai-save').on('click', function () {
      var widgetConfig = collectConfig();
      createOrUpdateUserAmplitude(widgetConfig);
      createOrUpdateUserUserDotCom(widgetConfig);
    })
  })
})(jQuery);


(function (e, t) {
  var n = e.amplitude || { _q: [], _iq: {} };
  var r = t.createElement("script");
  r.type = "text/javascript";
  r.integrity = "sha384-tzcaaCH5+KXD4sGaDozev6oElQhsVfbJvdi3//c2YvbY02LrNlbpGdt3Wq4rWonS";
  r.crossOrigin = "anonymous";
  r.async = true;
  r.src = "https://cdn.amplitude.com/libs/amplitude-8.5.0-min.gz.js";
  r.onload = function () {
    if (!e.amplitude.runQueuedFunctions) {
      console.log("[Amplitude] Error: could not load SDK");
    }
  };
  var i = t.getElementsByTagName("script")[0];
  i.parentNode.insertBefore(r, i);
  function s(e, t) {
    e.prototype[t] = function () {
      this._q.push([t].concat(Array.prototype.slice.call(arguments, 0)));
      return this;
    };
  }
  var o = function () {
    this._q = [];
    return this;
  };
  var a = ["add", "append", "clearAll", "prepend", "set", "setOnce", "unset", "preInsert", "postInsert", "remove"];
  for (var c = 0; c < a.length; c++) {
    s(o, a[c]);
  }
  n.Identify = o;
  var u = function () {
    this._q = [];
    return this;
  };
  var l = ["setProductId", "setQuantity", "setPrice", "setRevenueType", "setEventProperties"];
  for (var p = 0; p < l.length; p++) {
    s(u, l[p]);
  }
  n.Revenue = u;
  var d = [
    "init",
    "logEvent",
    "logRevenue",
    "setUserId",
    "setUserProperties",
    "setOptOut",
    "setVersionName",
    "setDomain",
    "setDeviceId",
    "enableTracking",
    "setGlobalUserProperties",
    "identify",
    "clearUserProperties",
    "setGroup",
    "logRevenueV2",
    "regenerateDeviceId",
    "groupIdentify",
    "onInit",
    "logEventWithTimestamp",
    "logEventWithGroups",
    "setSessionId",
    "resetSessionId"
  ];
  function v(e) {
    function t(t) {
      e[t] = function () {
        e._q.push([t].concat(Array.prototype.slice.call(arguments, 0)));
      };
    }
    for (var n = 0; n < d.length; n++) {
      t(d[n]);
    }
  }
  v(n);
  n.getInstance = function (e) {
    e = (!e || e.length === 0 ? "$default_instance" : e).toLowerCase();
    if (!Object.prototype.hasOwnProperty.call(n._iq, e)) {
      n._iq[e] = { _q: [] };
      v(n._iq[e]);
    }
    return n._iq[e];
  };
  e.amplitude = n;
})(window, document);

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

function setCookie(cookie_name, cookie_value, days) {
  var __d = new Date();
  __d.setTime(__d.getTime() + days * 24 * 60 * 60 * 1000);
  var __expires = "expires=" + __d.toUTCString();
  document.cookie = cookie_name + "=" + cookie_value + ";" + __expires + "; path=/; domain=." + window.location.hostname;
}

function filterPhoneNumber(phone) {
  return phone.split(" ").join("").split("+").join("")
}

function createOrUpdateUserAmplitude(widgetConfig) {
  var opt_config = {
    includeReferrer: true,
    includeUtm: true,
    includeGclid: true,
    saveParamsReferrerOncePerSession: true,
    logAttributionCapturedEvent: true
  };
  var opt_callback = function (instance) {
    if (readCookie("attributed") === null && user_id_for_amplitude != null) {
      //instance.logEvent("attributed");
      setCookie("attributed", "1", 365);
    }
  };
  var userProperties = {
    widgetType: widgetConfig.type,
    widgetSource: "wordpress-plugin",
    widgetDomain: window.location.hostname,
    clientEmail: widgetConfig.email,
    totalPages: widgetConfig.totalPages,
    blogTags: widgetConfig.blogTags,
    phone: filterPhoneNumber(widgetConfig.phone),
    email: widgetConfig.email,
  };
  var opt_callback = function (instance) {
    //instance.logEvent("visited");
    //console.log("identified");
    if (readCookie("attributed") === null && user_id_for_amplitude != null) {
      //instance.logEvent("attributed");
      setCookie("attributed", "1", 365);
    }
  };
  var user_id_for_amplitude = filterPhoneNumber(widgetConfig.phone);
  console.log("Amplitude Attribution: about to init the client instance");
  //console.log(user_id_for_amplitude)
  amplitude.getInstance().init("0e73dc7c6a30ebbc4bf3ea1144ebdb71", user_id_for_amplitude, opt_config, opt_callback);
  amplitude.getInstance().setUserProperties(userProperties);
}
function createOrUpdateUserUserDotCom(widgetConfig) {
  var data = JSON.stringify({
    "custom_id": filterPhoneNumber(widgetConfig.phone),
    "tags": ['Whatsapp Widget lead [WP]'],
    'widget_type': widgetConfig.type,
    'widget_domain': window.location.hostname,
    'widget_client_email': widgetConfig.email,
    'widget_total_pages': widgetConfig.totalPages,
    'widget_blog_tags': widgetConfig.blogTags,
    'email': widgetConfig.email,
    'phone_number': "+" + filterPhoneNumber(widgetConfig.phone)
  });
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;
  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === 4) {
      console.log(this.responseText);
    }
  });

  xhr.open("POST", "https://timelines.user.com/api/public/users/update_or_create/");
  xhr.setRequestHeader("authorization", "Token 7ejFynnLr2EYQu36DkIfSBOqrGySdxVi0uv641R3bx5fOfvxZvDmYZw8GPQJPcYQ");
  xhr.setRequestHeader("accept", "*/*; version=2");
  xhr.setRequestHeader("content-type", "application/json");

  xhr.send(data);
}
