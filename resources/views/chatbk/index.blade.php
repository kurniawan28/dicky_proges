@extends('layouts.app')

@section('content')

<style>
/* ============================= */
/* GLOBAL STYLING                */
/* ============================= */

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color: #e2e8f0;
    min-height: 100vh;
    padding-top: 80px;
}

/* Full width container */
.container, #app {
    max-width: 100% !important;
    width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
}

/* ============================= */
/* CHAT WRAPPER                  */
/* ============================= */
.chat-wrapper {
    max-width: 900px;
    width: 95%;
    margin: 30px auto;
    padding: 20px;
    background: #141724;
    border-radius: 10px;
    box-shadow: 0 0 15px #0ff;
}

/* Header */
.chat-header {
    text-align: center;
    margin-bottom: 15px;
    font-weight: bold;
    font-size: 1.5rem;
    color: #0ff;
}

/* Chat box */
.chat-box {
    height: 500px;
    overflow-y: auto;
    padding: 15px;
    background: #1A2138;
    border-radius: 10px;
    border: 1px solid #0ff;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Scrollbar */
.chat-box::-webkit-scrollbar {
    width: 8px;
}
.chat-box::-webkit-scrollbar-thumb {
    background: #ff00ff;
    border-radius: 4px;
}

/* User message (right) */
.msg-user {
    background: #ff00ff;
    color: white;
    padding: 10px 15px;
    border-radius: 18px 18px 5px 18px;
    max-width: 75%;
    align-self: flex-end;
    box-shadow: 0 0 8px #ff00ff;
}

/* AI message (left) */
.msg-ai {
    background: #0ff;
    color: #121212;
    padding: 10px 15px;
    border-radius: 18px 18px 18px 5px;
    max-width: 75%;
    align-self: flex-start;
    box-shadow: 0 0 8px #0ff;
}

/* Error message */
.msg-system-error {
    background: #dc3545;
    color: #fff;
    padding: 10px 15px;
    border-radius: 8px;
    max-width: 70%;
    align-self: flex-start;
    box-shadow: 0 0 5px #dc3545;
}

/* Input area */
.chat-input-area {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.chat-input-area input {
    flex: 1;
    background: #252525;
    color: #0ff;
    border: none;
    padding: 12px;
    border-radius: 10px;
    box-shadow: 0 0 5px #0ff inset;
}

.chat-input-area button {
    background: #ff00ff;
    padding: 12px 25px;
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 0 5px #ff00ff;
}

/* Navbar */
.navbar-fixed {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 50;
    background: rgba(15, 23, 42, 0.9);
    backdrop-filter: blur(6px);
    border-bottom: 1px solid #334155;
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>

<!-- NAVBAR -->
<nav class="navbar-fixed">
    <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-white">🏫 Sistem BK Sekolah</a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="logout-btn text-white py-2 px-5 rounded-lg bg-red-600 hover:bg-red-700">Logout</button>
    </form>
</nav>

<div class="chat-wrapper">

    <div class="chat-header">
        {{ $role == 'GURU_BK' ? '💬 BK AI Mode Guru' : '💬 Konseling AI Siswa' }}
    </div>

    <div id="chat-box" class="chat-box"></div>

    <div class="chat-input-area">
        <input type="text" id="message" placeholder="Tulis pesan kamu...">
        <button id="send">Kirim</button>
    </div>
</div>

<script>
const sendBtn = document.getElementById('send');
const msgInput = document.getElementById('message');
const chatBox = document.getElementById('chat-box');

function addMessage(text, type) {
    const div = document.createElement("div");
    div.className = type;
    div.textContent = text;
    chatBox.appendChild(div);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function sendMessage() {
    const text = msgInput.value.trim();
    if (!text) return;

    // tampilkan pesan user
    addMessage(text, "msg-user");
    msgInput.value = "";

    // request ke backend
    fetch("{{ route('chat.bk.send') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ message: text })
    })
    .then(res => res.json())
    .then(data => {
        addMessage(data?.message ?? "AI tidak memberikan respon.", "msg-ai");
    })
    .catch(() => {
        addMessage("Error: Gagal mengirim pesan.", "msg-system-error");
    });
}

// tombol kirim
sendBtn.addEventListener("click", sendMessage);

// Enter key
msgInput.addEventListener("keypress", function(e){
    if (e.key === "Enter") {
        e.preventDefault();
        sendMessage();
    }
});
</script>

@endsection
