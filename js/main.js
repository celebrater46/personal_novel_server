"use strict";

const storage = localStorage;
const current_url = location.pathname;
const current_parameter = location.search === "" ? "?family=0&size=5&color=0&x=1" : location.search;

// get data from local storage
// ?family=0&size=5&color=0&x=1
const ls_font_family = typeof storage.font_family != "undefined" ? parseInt(storage.font_family) : null;
const ls_font_size = typeof storage.font_size != "undefined" ? parseInt(storage.font_size) : null;
const ls_bg_color = typeof storage.bg_color != "undefined" ? parseInt(storage.bg_color) : null;
const ls_xy = typeof storage.xy != "undefined" ? parseInt(storage.xy) : null;

const body = document.querySelector("body");
const font_family = document.querySelector('[name="font_family"]');
const font_family_options = document.querySelectorAll("#font_family option");
const font_size = document.querySelector("#font_size");
const font_size_options = document.querySelectorAll("#font_size option");
const color = document.querySelector("#color");
const color_options = document.querySelectorAll("#color option");
const xy = document.querySelector("#xy");
const xy_options = document.querySelectorAll("#xy option");

font_family.onchange = event => {
    const new_url = current_url + current_parameter.substring(0, 8) + font_family.selectedIndex + current_parameter.substring(9);
    window.location.href = new_url;
}

// font_size.onchange = event => {
//     const new
// }
