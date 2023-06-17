@extends('adminlte::page')

@section('content_header')

<style>
    /* Chat Area CSS Start */
.chat-area header{
  display: flex;
  align-items: center;
  padding: 18px 30px;
}
.chat-area header .back-icon{
  color: #333;
  font-size: 18px;
}
.chat-area header img{
  height: 45px;
  width: 45px;
  margin: 0 15px;
}
.chat-area header .details span{
  font-size: 17px;
  font-weight: 500;
}
.chat-box{
  position: relative;
  min-height: 450px;
  max-height: 450px;
  overflow-y: auto;
  padding: 10px 30px 20px 30px;
  background: #f7f7f7;
  box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
              inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
}
.chat-box .text{
  position: absolute;
  top: 45%;
  left: 50%;
  width: calc(100% - 50px);
  text-align: center;
  transform: translate(-50%, -50%);
}
.chat-box .chat{
  margin: 15px 0;
}
.chat-box .chat p{
  word-wrap: break-word;
  padding: 8px 16px;
  box-shadow: 0 0 32px rgb(0 0 0 / 8%),
              0rem 16px 16px -16px rgb(0 0 0 / 10%);
}
.chat-box .outgoing{
  display: flex;
}
.chat-box .outgoing .details{
  margin-left: auto;
  max-width: calc(60% - 130px);
}
.outgoing .details p{
  background: #333;
  color: #fff;
  border-radius: 18px 18px 0 18px;
}
.outgoing .details span {
    font-size: 12px;
    color: #888;
    margin-top: 5px;
    float: right;
}

.chat-box .incoming{
  display: flex;
  align-items: flex-end;
}
.chat-box .incoming img{
  height: 35px;
  width: 35px;
}
.chat-box .incoming .details{
  margin-right: auto;
  margin-left: 10px;
  max-width: calc(60% - 130px);
}
.incoming .details p{
  background: #fff;
  color: #333;
  border-radius: 18px 18px 18px 0;
}
.incoming .details span {
    font-size: 12px;
    color: #888;
    margin-top: 5px;
    float: right;
}
.typing-area{
  padding: 18px 30px;
  display: flex;
  justify-content: space-between;
}
.typing-area input{
  height: 45px;
  width: calc(100% - 58px);
  font-size: 16px;
  padding: 0 13px;
  border: 1px solid #e6e6e6;
  outline: none;
  border-radius: 5px 0 0 5px;
}
.typing-area button{
  color: #fff;
  width: 55px;
  border: none;
  outline: none;
  background: #333;
  font-size: 19px;
  cursor: pointer;
  opacity: 0.7;
  pointer-events: auto;
  border-radius: 0 5px 5px 0;
  transition: all 0.3s ease;
}
.typing-area button.active{
  opacity: 1;
  pointer-events: auto;
}

    /* Users List CSS Start */
.users{
  padding: 25px 30px;
}
.users header,
.users-list a{
  display: flex;
  align-items: center;
  padding-bottom: 20px;
  border-bottom: 1px solid #e6e6e6;
  justify-content: space-between;
}
.wrapper img{
  object-fit: cover;
  border-radius: 50%;
}
.users header img{
  height: 50px;
  width: 50px;
}
:is(.users, .users-list) .content{
  display: flex;
  align-items: center;
}
:is(.users, .users-list) .content .details{
  color: #000;
  margin-left: 20px;
}
:is(.users, .users-list) .details span{
  font-size: 18px;
  font-weight: 500;
}
.users header .logout{
  display: block;
  background: #333;
  color: #fff;
  outline: none;
  border: none;
  padding: 7px 15px;
  text-decoration: none;
  border-radius: 5px;
  font-size: 17px;
}
.users .search{
  margin: 20px 0;
  display: flex;
  position: relative;
  align-items: center;
  justify-content: space-between;
}
.users .search .text{
  font-size: 18px;
}
.users .search input{
  position: absolute;
  height: 42px;
  width: calc(100% - 50px);
  font-size: 16px;
  padding: 0 13px;
  border: 1px solid #e6e6e6;
  outline: none;
  border-radius: 5px 0 0 5px;
  opacity: 0;
  pointer-events: none;
  transition: all 0.2s ease;
}
.users .search input.show{
  opacity: 1;
  pointer-events: auto;
}
.users .search button{
  position: relative;
  z-index: 1;
  width: 47px;
  height: 42px;
  font-size: 17px;
  cursor: pointer;
  border: none;
  background: #fff;
  color: #333;
  outline: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.2s ease;
}
.users .search button.active{
  background: #333;
  color: #fff;
}
.search button.active i::before{
  content: '\f00d';
}
.users-list{
  max-height: 350px;
  overflow-y: auto;
}
:is(.users-list, .chat-box)::-webkit-scrollbar{
  width: 0px;
}
.users-list a{
  padding-bottom: 10px;
  margin-bottom: 15px;
  padding-right: 15px;
  border-bottom-color: #f1f1f1;
}
.users-list a:last-child{
  margin-bottom: 0px;
  border-bottom: none;
}
.users-list a img{
  height: 40px;
  width: 40px;
}
.users-list a .details p{
  color: #67676a;
}
.users-list a .status-dot{
  font-size: 12px;
  color: #468669;
  padding-left: 10px;
}
.users-list a .status-dot.offline{
  color: #ccc;
}

.chat-box div .cnull{
  background: #ccc;
  border-radius: 10px;
}

.timestamp{
  margin-left: 10px;
}

.btn-primary{
    color: #fff;
    background-color: #1D3456;
    border-color: #1D3456;
}
.btn-primary:hover{
    color: #fff;
    background-color: #346FB3;
    border-color: #346FB3;
    box-shadow: rgb(23 24 25 / 50%) -2px 2px 6px 0px, rgb(28 29 30 / 50%) 0px 0px 0px 0px;
}
</style>
        
<div class="col-sm-12">
    <div class="card card-body p-0">
        <header class="chat-head" style="background: #E3E6EB">
            <div class="row">
                <div class="col-sm-1 my-auto">
                    <i class="fas fa-user ml-4"></i>
                </div>
                <div class="col-sm-9" style="margin-top: 10px;">
                    <div class="details">
                    <span>{{$receiver->name}}</span>
                    <p>Online</p>
                    </div>
                </div>
                
                {{-- last sini --}}
                @if(auth()->user()->hasRole([5]))
                    <div class="col-sm-2 my-auto w-75">
                      <form class="form-inline d-flex justify-content-center" id="submitstatus" action="{{ route('conversation.update', ['uuid' => $uuid]) }}" method="POST">
                          @csrf
                          <button type="button" class="btn btn-primary" id="endSessionBtn">
                              {{__('End Session')}}
                          </button>
                      </form>
                    </div>
                @endif
            </div>
        </header>
        <div class="chat-box" id="chat-messages">
          @if(empty($conversations))
            <div class="px-auto align-center">
              <p class="mx-auto w-50 text-center cnull"> no chat availables </p>
            </div>
          @else
            @foreach ($conversations as $key => $message)
              @if(auth()->user()->hasRole([5]))
                @if (strpos($key, 'receiver') !== false)
                    <div class="chat outgoing">
                        <div class="details">
                            <p>{{ $message['message'] }}<span class="timestamp">{{ $message['timestamp'] }}</span></p>
                        </div>
                    </div>
                @elseif (strpos($key, 'sender') !== false)
                    <div class="chat incoming">
                        <i class="fas fa-user"></i>
                        <div class="details">
                            <p>{{ $message['message'] }}<span class="timestamp">{{ $message['timestamp'] }}</span></p>
                        </div>
                    </div>
                @endif
              @else
                @if (strpos($key, 'sender') !== false)
                    <div class="chat outgoing">
                        <div class="details">
                            <p>{{ $message['message'] }}<span class="timestamp">{{ $message['timestamp'] }}</span></p>
                        </div>
                    </div>
                @elseif (strpos($key, 'receiver') !== false)
                    <div class="chat incoming">
                        <i class="fas fa-user"></i>
                        <div class="details">
                            <p>{{ $message['message'] }}<span class="timestamp">{{ $message['timestamp'] }}</span></p>
                        </div>
                    </div>
                @endif
              @endif
            @endforeach
          @endif
        </div>

        <form action="{{ route('conversation.send', ['uuid' => $uuid]) }}" class="typing-area" method="POST">
            @csrf
            <input type="text" class="incoming_id" name="incoming_id" value="{{ $uuid }}" hidden>
            <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
            <button type="submit"><i class="fab fa-telegram-plane"></i></button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    var chatMessagesContainer = document.getElementById('chat-messages');
    var isUpdating = false; // Flag to prevent multiple simultaneous Ajax requests

    function scrollToBottom() {
      chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
    }

    function updateChatMessages() {
      if (isUpdating) {
        return; // If an update is already in progress, exit the function
      }

      isUpdating = true; // Set the flag to indicate an update is in progress

      $.ajax({
        url: '{{ route("conversation", $uuid) }}',
        type: 'GET',
        success: function(data) {
          $('#chat-messages').html($(data).find('#chat-messages').html());
          isUpdating = false; // Reset the flag after the update is complete
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          isUpdating = false; // Reset the flag on error as well
        }
      });
    }

    scrollToBottom();
    updateChatMessages();
    setInterval(updateChatMessages, 1000);
  });

  $(document).ready(function() {
    // Confirm dialog on button click
    $('#endSessionBtn').on('click', function() {
        swal.fire({
            title: "Confirmation",
            text: "Are you sure you want to end the session?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: false,
                    className: "swal-cancel-button",
                },
                confirm: {
                    text: "End Session",
                    value: true,
                    className: "swal-confirm-button",
                },
            },
            closeOnConfirm: true,
            closeOnCancel: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with form submission
                $('#submitstatus').submit();
            }
        });
    });
});

</script>

@endsection