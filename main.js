class Chat {
    constructor() {
        this.activeId = ""
        this.me = '5'
        this.users = document.querySelectorAll(".users li")
        this.messageInput = document.querySelector("#chatFormInput")
        this.messageText = ''
    }

    activeUser = async (e) => {
        // remove active from prev
        const currentActive = document.querySelector(".users .active")
        if (currentActive) currentActive.classList.remove("active")

        // update current active
        this.activeId = e.target.getAttribute("id")
        e.target.classList.add("active")

        // load chat between current user (me) and the activeId
        // into the chat thread/list.

        const res = await fetch(`get_messages.php?from=${this.me}&to=${this.activeId}`, {
            method: "GET",
            headers: {
                "Cache-Control": "no-cache, no-store, max-age=0",
                "Accept": "text/html"
            }
        })

        if (res.ok) {
            const messages = document.querySelector('#messages.card .message-list')
            messages.innerHTML = await res.text()
        }

        // this.scrollMessageList()
    }

    updateMessageText = (e) => {
        this.messageText = e.target.value
    }

    scrollMessageList =  () => {
        const msgElement = document.getElementById("messages");
        console.log(msgElement.scrollHeight)
        //msgElement.scrollBottom = msgElement.scrollHeight;
        msgElement.scroll({ bottom: msgElement.scrollHeight, behavior: 'smooth' });
    }

    sendMessage = async (e) => {

        if (e.key !== "Enter") {
            // Just update and go back(return)
            this.messageText = e.target.value
            return
        }
        console.log(this.messageText)
        console.log("HERE AGAIN")
        const res = await fetch(`sse.php`, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                'from': this.me,
                'to': this.activeId,
                'message': this.messageText,

            })
        })

        console.log(res)
        e.target.value = ""
    }

}


const chat = new Chat()

chat.users.forEach(user => {
    user.addEventListener("click", chat.activeUser)
})

//chat.messageInput.addEventListener("change", chat.updateMessageText)
chat.messageInput.addEventListener("keyup", chat.sendMessage)