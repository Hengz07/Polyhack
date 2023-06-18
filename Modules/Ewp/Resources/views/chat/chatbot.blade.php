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
                        <span>PolyHealth ChatBot</span>
                        <p>Online</p>
                    </div>
                </div>
            </div>
        </header>
        <div class="chat-box" id="chat-messages">
            <div class="chat incoming">
                <i class="fas fa-user"></i>
                <div class="details">
                    <p>Welcome to the PolyHealth ChatBot! Stressed?? Despressed?? Anxiety?? How can I assist you today?<span class="timestamp">{{ now()->format('H:i') }}</span></p>
                </div>
            </div>
        </div>

        <form class="typing-area">
            <input type="text" class="input-field" placeholder="Type a message here..." autocomplete="off">
            <button type="submit"><i class="fab fa-telegram-plane"></i></button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.typing-area').submit(function (e) {
            e.preventDefault();
            var message = $('.input-field').val();

            if (message.trim() !== '') {
                $('.input-field').val('');

                $('.chat-box').append(`
                    <div class="chat outgoing">
                        <div class="details">
                            <p>${message}<span class="timestamp">${getCurrentTime()}</span></p>
                        </div>
                    </div>
                `);

                // Check if the user's message is a specific trigger for auto-reply
                if (message.toLowerCase().includes('mental health')) {
                    // Simulating auto-reply after a delay
                    setTimeout(function () {
                        $('.chat-box').append(`
                            <div class="chat incoming">
                                <i class="fas fa-user"></i>
                                <div class="details">
                                    <p>Hi, Sure. It's important to prioritize our mental well-being. What specific aspect of mental health would you like to discuss?<span class="timestamp">${getCurrentTime()}</span></p>
                                </div>
                            </div>
                        `);
                    }, 1000);
                }

                if (message.toLowerCase().includes('stress')) {
                    // Simulating auto-reply after a delay
                    setTimeout(function () {
                        $('.chat-box').append(`
                            <div class="chat incoming">
                                <i class="fas fa-user"></i>
                                <div class="details">
                                    <p>I'm sorry to hear that you're feeling stressed. Here are a few suggestions that might help:<br><br>1) Take a deep breath: Close your eyes and take slow, deep breaths. Focus on your breath as you inhale and exhale slowly. This can help calm your mind and body.<br>2) Identify the source of stress: Try to identify what is causing your stress. Is it work-related, personal issues, or something else? Understanding the source of your stress can help you find ways to address it.<br>3) Practice self-care: Take some time for yourself and engage in activities that help you relax and recharge. This could be anything from taking a walk in nature, reading a book, listening to calming music, or practicing a hobby you enjoy.<br>4) Reach out for support: Talk to someone you trust about how you're feeling. Sharing your thoughts and emotions can provide relief and support. It could be a friend, family member, or even a professional counselor or therapist.<br>5) Prioritize and organize: Make a to-do list or prioritize your tasks to bring some order to your day. Breaking tasks into smaller, manageable steps can make them feel less overwhelming.<br>6) Take breaks: Give yourself regular breaks throughout the day to rest and recharge. Engage in activities that help you relax, such as stretching, meditating, or taking short walks.<br>7) Get enough sleep: Make sure you're getting adequate sleep each night. A well-rested mind and body are better equipped to handle stress.<br><br>Remember, it's normal to feel stressed from time to time, but it's essential to take care of yourself and seek support when needed. If your stress persists or becomes overwhelming, consider reaching out to a healthcare professional for further assistance.<span class="timestamp">${getCurrentTime()}</span></p>
                                </div>
                            </div>
                        `);
                    }, 1000);
                }

                if (message.toLowerCase().includes('depress')) {
                    // Simulating auto-reply after a delay
                    setTimeout(function () {
                        $('.chat-box').append(`
                            <div class="chat incoming">
                                <i class="fas fa-user"></i>
                                <div class="details">
                                    <p>I'm sorry to hear that you're feeling depressed. Here are a few suggestions that might help:<br><br>1) Reach out for support: Talk to someone you trust about how you're feeling. Sharing your thoughts and emotions can provide relief and support. It could be a friend, family member, or even a professional counselor or therapist.<br>2) Practice self-care: Take care of yourself physically and emotionally. Engage in activities that bring you joy, such as hobbies, exercise, or spending time in nature.<br>3) Establish a routine: Create a daily schedule that includes activities you enjoy and find purposeful. Having structure in your day can provide a sense of stability.<br>4) Set realistic goals: Break tasks into smaller, manageable steps. Celebrate your achievements, no matter how small they may seem.<br>5) Seek professional help: Consider reaching out to a mental health professional who can provide guidance and support. They can help develop an appropriate treatment plan for your specific needs.<br>6) Avoid self-isolation: Stay connected with supportive friends and family members. Social interaction, even if it's virtual or limited, can provide a sense of belonging.<br>7) Practice self-compassion: Be kind to yourself and understand that it's okay to have good and bad days. Treat yourself with the same care and understanding you would offer to a friend.<br>8) Engage in relaxation techniques: Explore techniques such as deep breathing exercises, meditation, or mindfulness to help calm your mind and reduce stress.<br><br>Remember, depression is a serious condition, and it's important to seek professional help if your symptoms persist or worsen. You don't have to face it alone, and there are resources available to support you on your journey to recovery.<span class="timestamp">${getCurrentTime()}</span></p>
                                </div>
                            </div>
                        `);
                    }, 1000);
                }

                if (message.toLowerCase().includes('anxiety')) {
                    // Simulating auto-reply after a delay
                    setTimeout(function () {
                        $('.chat-box').append(`
                            <div class="chat incoming">
                                <i class="fas fa-user"></i>
                                <div class="details">
                                    <p>I'm sorry to hear that you're feeling anxious. Here are a few suggestions that might help:<br><br>1) Deep breathing exercises: Take slow, deep breaths in through your nose and exhale through your mouth. Focus on your breath as it enters and leaves your body. This can help regulate your breathing and bring a sense of calm.<br>2) Practice mindfulness: Engage in activities that help you stay present and focused, such as meditation, yoga, or guided imagery. Pay attention to your senses and observe the present moment without judgment.<br>3) Challenge negative thoughts: Identify and challenge anxious thoughts that may be causing distress. Replace them with more realistic and positive thoughts.<br>4) Stay active: Engage in regular physical activity, such as walking, jogging, or dancing. Exercise can help reduce anxiety and improve your mood.<br>5) Limit caffeine and alcohol: Caffeine and alcohol can increase anxiety symptoms. Consider reducing or avoiding these substances.<br>6) Get enough sleep: Ensure you're getting adequate sleep each night. Establish a relaxing bedtime routine and create a comfortable sleep environment.<br>7) Seek support: Talk to someone you trust about your anxiety, such as a friend, family member, or therapist. Sharing your feelings can provide relief and support.<br>8) Practice self-care: Engage in activities that bring you joy and relaxation, such as reading, listening to music, or spending time in nature. Take time for yourself and prioritize self-care.<br>9) Avoid excessive news consumption: Limit your exposure to news and social media, as constant updates can contribute to anxiety. Stay informed, but balance it with other positive activities.<br><br>Remember, it's normal to experience anxiety, but if your symptoms persist or significantly interfere with your daily life, consider seeking professional help. A healthcare professional can provide guidance and support tailored to your needs.<span class="timestamp">${getCurrentTime()}</span></p>
                                </div>
                            </div>
                        `);
                    }, 1000);
                }
            }
        });

        function getCurrentTime() {
            var date = new Date();
            var hours = date.getHours().toString().padStart(2, '0');
            var minutes = date.getMinutes().toString().padStart(2, '0');
            return hours + ':' + minutes;
        }
    });
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    var chatMessagesContainer = document.getElementById('chat-messages');
    var isUpdating = false; // Flag to prevent multiple simultaneous Ajax requests

    function scrollToBottom() {
      chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
    }

    scrollToBottom();
  });

</script>

@endsection