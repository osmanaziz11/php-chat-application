<?php
session_start();
if (!isset($_SESSION['verify_username'])) {
    header('Location:http://localhost:81/Malatist/login.php/');
}
else{
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome - Create Account</title>
    <!-- Favicon  -->
    <link rel="shortcut icon" href="assects\media\favicon.png" type="image/jpg" />
    <!-- Index.css  -->
    <link rel="stylesheet" href="assects\css\chat.css" />
    <!-- Bootstrap CDN  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet" />
    <!-- Font Awesome  -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>

    <!-- Main container  -->
    <div class="container my-5 shadow rounded" id="main_container">
        <div class="row h-100">
            <div class="col-3 h-100 overflow-scroll" id="contactBox">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <h4 class="text-center text-white pt-5">Welcome Malatist</h4>
                        </div>
                    </div>
                    <!-- Search Contact  -->
                    <div class="row my-3">
                        <div class="col">
                            <input id="searchBox" type="search" class="p-2" onkeyup="searchContact()"
                                onblur="userLeaves()" onfocus="searchActive()" name="" placeholder="search contact..."
                                id="">
                        </div>
                    </div>
                    <div class="row searchSuggestionBox">
                        <div class="col">
                            <ul class="p-0 m-0 contacts text-white  list-unstyled">
                            </ul>
                        </div>
                    </div>
                    <div class="container-fluid p-0 newChats d-none">
                        <p class="mt-3 mb-0 p-0 text-white">New Chats</p>
                        <!-- New Chats  -->
                        <div class="row ">
                            <div class="col">
                                <ul class="p-0 m-0 contacts text-white  list-unstyled">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0">
                        <p class="mt-3 mb-0 p-0 text-white">Recent Chats</p>
                        <!-- Recent Chats  -->
                        <div class="row recentChats">
                            <div class="col">
                                <ul class="p-0 m-0 contacts recent-chats text-white  list-unstyled">

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-9" id="chatBox">
                <!-- headere  -->
                <div class="container-fluid pt-3">
                    <div class="row header">
                        <div class="col-4 d-flex align-items-center">
                            <h4 class="text-white m-0"></h4>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <p class="m-0 text-white"></p>
                        </div>
                        <div class="col-4 d-flex justify-content-end align-items-center">
                            <a href="logout.php"><button class="logoutBtn  px-3 rounded shadow py-2">Logout</button></a>
                        </div>

                    </div>

                </div>
                <div class="container-fluid chat_room_container h-100 p-0">
                    <!-- By Default Chat Room  -->
                    <div class="row mt-3 w-100 h-100 default_chat_room">
                        <div class="col-12 w-100 d-flex justify-content-center align-items-center">
                            <!-- <i class="fa-solid fa-message-pen"></i> -->
                            <h4>start chating with your friend</h4>
                        </div>
                    </div>
                    <!-- chat room includes chat and send msg  -->
                    <div class="container-fluid chat_room d-none p-0">
                        <!-- chat -->
                        <div class="row mt-3 w-100">
                            <div class="col-12 w-100" id="chat">
                                <div class="container-fluid mt-3">
                                    <div class="row chat">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- sending msg  -->
                        <form onsubmit="sendMsg(event)">
                            <div class="row  mt-1">
                                <div class="col-10">
                                    <input type="text" name="msg" id="typeMsg" class="w-100 p-2"
                                        placeholder="Send message..." autocomplete="off">
                                </div>
                                <div class=" col-2 d-flex justify-content-end">
                                    <button type="submit" class="w-100 sendBtn rounded">Send Msg</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="assects/Js/jquery.js"></script>
    <script>
    // Global Variables 
    let activeUser = '';
    let connectUser = [];
    // -----------------
    // Send Message 
    const sendMsg = async (event) => {
        var time = new Date();
        event.preventDefault();
        let obj = {
            message: $('#typeMsg').val(),
            receiver: sessionStorage.getItem("receiver"),
            time: time.toLocaleString('en-US', {
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            })
        }
        if (!connectUser.find(element => element == obj.receiver)) {
            let req = await fetch('server/api/update-status.php', {
                "method": 'post',
                "body": JSON.stringify({
                    receiver: obj.receiver
                })
            });
        } else {

        }
        let req = await fetch('server/api/msg-to-db.php', {
            "method": 'post',
            "body": JSON.stringify(obj)
        });
        let data = await req.json();
        let errorCheck = '';
        if (data) {
            (data.status != 1) ? errorCheck = 'msgSendError': '';
            $('.chat_room .chat').append(`  <div class="col-12 mb-2 ${errorCheck} d-flex justify-content-end flex-column align-items-end">
                                            <div class="msg sender rounded shadow p-2 px-3">
                                               ${$('#typeMsg').val()}
                                            </div>
                                            <p class="mt-1  msgTime">${ time.toLocaleString('en-US', {
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            })}</p>
                                        </div>`)
            $('#typeMsg').val("");
        }



    }
    // New Chats 
    async function newChat() {
        let req = await fetch('server/api/new-chat.php', {
            'method': 'GET'
        });
        let data = await req.json();
        if (data) {
            if (data.status == 1) {
                $('.newChats').removeClass('d-none');
                data.record.map((item, index) => {
                    $('.newChats ul').append(`<li class="my-3 px-3 py-2" data-time=${item.last_active} data-name=${item.name} data-id=${item.email}>${item.name} <p class="p-0 m-0">@${item.email}</p>
                                </li>`)
                });
            }

        }
    }
    newChat();

    function addToRecent({
        name,
        email,
        last_active
    }) {
        $('.recentChats .col ul').append(`<li class="my-3 px-3 py-2" data-time=${last_active} data-name=${name} data-id=${email}>${name} <p class="p-0 m-0">@${email}</p>
                                </li>`)

    }
    // Recent Chats 
    (async function() {
        let req = await fetch('server/api/recent-chat.php', {
            'method': 'GET'
        });
        let data = await req.json();
        if (data) {
            $('.recentChats .col ul').html(``)
            data.status == 1 ?
                data.record.map((item, index) => {
                    connectUser.push(item.email);
                    addToRecent(item);
                }) : $('.recent-chats').html(`No record`)
        }
    }())

    // Open Chat 
    $(document).on('click', '.recentChats .col ul li', async function() {
        $(this).addClass('activeChat').siblings().removeClass('activeChat');
        sessionStorage.setItem("receiver", $(this).data('id'));
        let obj = {
            receiver_ID: sessionStorage.getItem("receiver")
        };
        let req = await fetch('server/api/get-chat.php', {
            "method": 'post',
            "body": JSON.stringify(obj)
        });
        let data = await req.json();
        if (data) {
            if (data.status == 1) {
                $('.default_chat_room').addClass('d-none');
                $('.chat_room').removeClass('d-none');
                $('.header h4').html($(this).data('name'));
                $('.header p').html(`Last Active : ${$(this).data('time')}`);
                $('.chat_room .chat').html('');
                data.record.map((item, index) => {

                    if (item.sender_ID == sessionStorage.getItem("activeUser")) {

                        $('.chat_room .chat').append(`<div class="col-12 mb-2 d-flex justify-content-end flex-column align-items-end">
                                            <div class="msg sender rounded shadow p-2 px-3">
                                               ${item.msg}
                                            </div>
                                            <p class="mt-1  msgTime">${ item.time}</p>
                                        </div>`)
                    } else {
                        $('.chat_room .chat').append(`  <div class="col-12 d-flex justify-content-end flex-column ">
                                            <div class="msg receiver p-2">
                                                ${item.msg}
                                            </div>
                                            <p class="mx-1 mt-1 msgTime">${ item.time}</p>
                                        </div>`)
                    }

                })
            } else {
                $('.default_chat_room').addClass('d-none');
                $('.chat_room').removeClass('d-none');
                $('.header h4').html($(this).data('name'));
                $('.header p').html(`Last Active : ${$(this).data('time')}`);
                $('.chat_room .chat').html('');
            }

        }
    })
    $(document).on('click', '.newChats .col ul li', async function() {
        $(this).addClass('activeChat').siblings().removeClass('activeChat');
        sessionStorage.setItem("receiver", $(this).data('id'));
        let obj = {
            receiver_ID: sessionStorage.getItem("receiver")
        };
        let req = await fetch('server/api/get-chat.php', {
            "method": 'post',
            "body": JSON.stringify(obj)
        });
        let data = await req.json();
        if (data) {
            if (data.status == 1) {
                $('.default_chat_room').addClass('d-none');
                $('.chat_room').removeClass('d-none');
                $('.header h4').html($(this).data('name'));
                $('.header p').html(`Last Active : ${$(this).data('time')}`);
                $('.chat_room .chat').html('');
                data.record.map((item, index) => {

                    if (item.sender_ID == sessionStorage.getItem("activeUser")) {

                        $('.chat_room .chat').append(`<div class="col-12 mb-2 d-flex justify-content-end flex-column align-items-end">
                                            <div class="msg sender rounded shadow p-2 px-3">
                                               ${item.msg}
                                            </div>
                                            <p class="mt-1  msgTime">${ item.time}</p>
                                        </div>`)
                    } else {
                        $('.chat_room .chat').append(`  <div class="col-12 d-flex justify-content-end flex-column ">
                                            <div class="msg receiver p-2">
                                                ${item.msg}
                                            </div>
                                               <p class="mx-1 mt-1 msgTime">${ item.time}</p>
                                        </div>`)
                    }

                })
            } else {
                $('.default_chat_room').addClass('d-none');
                $('.chat_room').removeClass('d-none');
                $('.header h4').html($(this).data('name'));
                $('.header p').html(`Last Active : ${$(this).data('time')}`);
                $('.chat_room .chat').html('');
            }

        }
    })
    $(document).on('click', '.searchSuggestionBox .col ul li', async function() {
        $(this).addClass('activeChat').siblings().removeClass('activeChat');
        sessionStorage.setItem("receiver", $(this).data('id'));
        let obj = {
            receiver_ID: sessionStorage.getItem("receiver")
        };
        let req = await fetch('server/api/get-chat.php', {
            "method": 'post',
            "body": JSON.stringify(obj)
        });
        let data = await req.json();
        if (data) {
            if (data.status == 1) {
                $('.default_chat_room').addClass('d-none');
                $('.chat_room').removeClass('d-none');
                $('.header h4').html($(this).data('name'));
                $('.header p').html(`Last Active : ${$(this).data('time')}`);
                $('.chat_room .chat').html('');
                data.record.map((item, index) => {

                    if (item.sender_ID == sessionStorage.getItem("activeUser")) {

                        $('.chat_room .chat').append(`<div class="col-12 mb-2 d-flex justify-content-end flex-column align-items-end">
                                            <div class="msg sender rounded shadow p-2 px-3">
                                               ${item.msg}
                                            </div>
                                            <p class="mt-1  msgTime">${ item.time}</p>
                                        </div>`)
                    } else {
                        $('.chat_room .chat').append(`  <div class="col-12 d-flex justify-content-end flex-column ">
                                            <div class="msg receiver rounded shadow p-2 px-3">
                                               ${item.msg}
                                            </div>
                                               <p class="mx-1 mt-1 msgTime">${item.time}</p>
                                        </div>`)
                    }

                })
            } else {
                $('.default_chat_room').addClass('d-none');
                $('.chat_room').removeClass('d-none');
                $('.header h4').html($(this).data('name'));
                $('.header p').html(`Last Active : ${$(this).data('time')}`);
                $('.chat_room .chat').html('');
            }

        }
    })

    // When User leaves search input 
    const userLeaves = () => {
        // $('.searchSuggestionBox').addClass("h-0");
    }
    // Search Focus 
    const searchActive = () => {
        $('.searchSuggestionBox').removeClass("h-0");
    }

    const searchContact = async (event) => {
        let element = document.getElementById('searchBox').value;
        let object = {
            searchKey: element
        }
        var json = JSON.stringify(object);
        console.log(json)
        let req = await fetch('server/api/search.php', {
            'method': 'POST',
            'body': json,
        });
        let data = await req.json();
        if (data) {
            $('.searchSuggestionBox .col ul').html(`
                                                    `)
            data.status == 1 ?
                data.record.map((item, index) => {
                    $('.searchSuggestionBox .col ul').append(`<li class="my-3 px-3 py-2" data-time=${item.last_active} data-name=${item.name} data-id=${item.email}>${item.name} <p class="p-0 m-0">@${item.email}</p>
                                </li>`)

                }) : $('.searchSuggestionBox .col ul').html(`
                                                    No record `)
        }
    }
    </script>
</body>

</html>