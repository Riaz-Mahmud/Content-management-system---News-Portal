(function(w, d) {
    w.PushEngage = w.PushEngage || [];
    PushEngage.push(['init', {
        appId: '61a71ead19398fba5514eb0ef83d600c',
        isLegacySDK: true,
        isShopifySite: false
    }]);

    const e = d.createElement('script');

    e.src = 'https://clientcdn.pushengage.com/sdks/pushengage-web-sdk.js';
    e.async = true;
    e.type = 'text/javascript';
    d.head.appendChild(e);
  })(window, document);(()=>{"use strict";var e,n={837:(e,n)=>{Object.defineProperty(n,"__esModule",{value:!0}),n.getV1SDKMethods=void 0,n.getV1SDKMethods=function(){return{subscribe:function(e,n){window._peq=window._peq||[],window._peq.push(["init",e,n])},isSubscribed:function(e){window._peq=window._peq||[],window._peq.push(["is-subscribed",e])},addSubscriberToSegment:function(e,n){window._peq=window._peq||[],window._peq.push(["add-to-segment",e,n])},removeSubscriberFromSegment:function(e,n){window._peq=window._peq||[],window._peq.push(["remove-to-segment",e,n])},addProfileId:function(e,n){window._peq=window._peq||[],window._peq.push(["add-to-profile",e,n])},addSubscriberToDynamicSegment:function(e,n,o){window._peq=window._peq||[],window._peq.push(["add-to-dynamic-segment",e,n,o])},addSegmentsInStorage:function(){}}}}},o={};e=function e(i){var d=o[i];if(void 0!==d)return d.exports;var t=o[i]={exports:{}};return n[i](t,t.exports,e),t.exports}(837),"undefined"!=typeof window&&(window._pe=Object.freeze((0,e.getV1SDKMethods)()))})();