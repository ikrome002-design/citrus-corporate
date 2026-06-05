/*

Elfsight Social Media Icons
Version: 1.3.0
Release date: Thu Apr 26 2018

https://elfsight.com

Copyright (c) 2018 Elfsight, LLC. ALL RIGHTS RESERVED

*/(window.eapps=window.eapps||{}).observer=function(e,o,p){"object"==typeof p&&p.$watch("currentComplex",function(e){e&&(o[0].complex.properties[1].select.options.forEach(function(o){e.url&&!e.type&&-1!==e.url.indexOf(o.value)&&(e.type=o.name.toLowerCase(),p.controls&&p.controls.type&&p.controls.type.set(e.type))}),r("iconUrl",!(!e.type||"custom"!==e.type),o))},!0);var r=function(e,o,p){p.forEach(function(t,s){if(t.id===e)return p[s].visible=o,!1;t&&t.properties&&r(e,o,t.properties),t.complex&&t.complex.properties&&r(e,o,t.complex.properties),t.subgroup&&t.subgroup.properties&&r(e,o,t.subgroup.properties)})}};