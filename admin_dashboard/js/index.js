// var slider_table = document.getElementById('slider_table');
// var news_table = document.getElementById('news_table');
// var marquee_table = document.getElementById('marquee_table');
// var admin = document.getElementById('admin_form');
// var sub_admin = document.getElementById('sub_admin_form');
// var main_content = document.getElementById('main_content');

// var form2 = document.getElementById('state_form');
// var form3 = document.getElementById('city_form');
// var user_slider_list = document.getElementById('user_slider_table');
// var user_news_list = document.getElementById('user_news_table');
// var user_marquee_list = document.getElementById('user_marquee_table');
// var user_form = document.getElementById('user_form'); // Added user form for country handling

// // Function for toggling dashboard view
// function dashboard() {
//     if (main_content.style.display === "none") {
//         slider_table.style.display = "none";
//         news_table.style.display = "none";
//         marquee_table.style.display = "none";
//         admin.style.display = "none";
//         sub_admin.style.display = "none";
//         main_content.style.display = "block";
//     } else {
//         main_content.style.display = "none";
//     }
// }

// // Function for country list display
// function showCountryList() {
//     if (slider_table.style.display === "none") {
//         slider_table.style.display = "block";
//         news_table.style.display = "none";
//         marquee_table.style.display = "none";
//         admin.style.display = "none";
//         sub_admin.style.display = "none";
//         main_content.style.display = "none";
//     } else {
//         slider_table.style.display = "none";
//     }
// }

// // Function for state list display
// function showStateList() {
//     if (news_table.style.display === "none") {
//         slider_table.style.display = "none";
//         news_table.style.display = "block";
//         marquee_table.style.display = "none";
//         admin.style.display = "none";
//         sub_admin.style.display = "none";
//         main_content.style.display = "none";
//     } else {
//         news_table.style.display = "none";
//     }
// }

// // Function for city list display
// function showCityList() {
//     if (marquee_table.style.display === "none") {
//         slider_table.style.display = "none";
//         news_table.style.display = "none";
//         marquee_table.style.display = "block";
//         admin.style.display = "none";
//         sub_admin.style.display = "none";
//         main_content.style.display = "none";
//     } else {
//         marquee_table.style.display = "none";
//     }
// }

// // Function for admin view
// function showAdminView() {
//     if (admin.style.display === "none") {
//         admin.style.display = "block";
//         sub_admin.style.display = "none";
//         slider_table.style.display = "none";
//         news_table.style.display = "none";
//         marquee_table.style.display = "none";
//         main_content.style.display = "none";
//     } else {
//         admin.style.display = "none";
//     }
// }

// // Function for sub-admin view
// function showSubAdminView() {
//     if (sub_admin.style.display === "none") {
//         sub_admin.style.display = "block";
//         admin.style.display = "none";
//         slider_table.style.display = "none";
//         news_table.style.display = "none";
//         marquee_table.style.display = "none";
//         main_content.style.display = "none";
//     } else {
//         sub_admin.style.display = "none";
//     }
// }

// // Function to show user form
// function showUserForm() {
//     if (user_form.style.display === "none") {
//         user_form.style.display = "block";
//         sub_admin.style.display = "none";
//         admin.style.display = "none";
//         news_table.style.display = "none";
//         marquee_table.style.display = "none";
//         main_content.style.display = "none";
//     } else {
//         user_form.style.display = "none";
//     }
// }

// // Function to show state form
// function showStateForm() {
//     console.log('news');
//     if (form2.style.display === "none") {
//         form2.style.display = "block";
//         form3.style.display = "none";
//         slider_table.style.display = "none";
//         news_table.style.display = "none";
//         marquee_table.style.display = "none";
//         admin.style.display = "none";
//         sub_admin.style.display = "none";
//         main_content.style.display = "none";
//     } else {
//         form2.style.display = "none";
//     }
// }

// // Function to show city form
// function showCityForm() {
//     console.log('marquee');
//     if (form3.style.display === "none") {
//         form2.style.display = "none";
//         form3.style.display = "block";
//         slider_table.style.display = "none";
//         news_table.style.display = "none";
//         marquee_table.style.display = "none";
//         admin.style.display = "none";
//         sub_admin.style.display = "none";
//         main_content.style.display = "none";
//     } else {
//         form3.style.display = "none";
//     }
// }

// // Function to show user slider list
// function showUserSliderList() {
//     if (user_slider_list.style.display === "none" || user_slider_list.style.display === "") {
//         user_slider_list.style.display = "block";
//         user_news_list.style.display = "none";
//         user_marquee_list.style.display = "none";
//     } else {
//         user_slider_list.style.display = "none";
//     }
// }

// // Function to show user news list
// function showUserNewsList() {
//     if (user_news_list.style.display === "none" || user_news_list.style.display === "") {
//         user_news_list.style.display = "block";
//         user_slider_list.style.display = "none";
//         user_marquee_list.style.display = "none";
//     } else {
//         user_news_list.style.display = "none";
//     }
// }

// // Function to show user marquee list
// function showUserMarqueeList() {
//     if (user_marquee_list.style.display === "none" || user_marquee_list.style.display === "") {
//         user_marquee_list.style.display = "block";
//         user_slider_list.style.display = "none";
//         user_news_list.style.display = "none";
//     } else {
//         user_marquee_list.style.display = "none";
//     }
// }

