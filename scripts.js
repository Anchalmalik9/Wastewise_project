AOS.init({
    duration: 1200,
    once: true
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {

    anchor.addEventListener('click', function (e) {

        e.preventDefault();

        document.querySelector(
            this.getAttribute('href')
        ).scrollIntoView({
            behavior: 'smooth'
        });

    });

});


// CHATBOT

let promptInput =
    document.querySelector("#prompt");

let submitBtn =
    document.querySelector("#submit");

let chatContainer =
    document.querySelector(".chat-container");


function botReply(message) {

    message = message.toLowerCase();

    if (
        message.includes("hello") ||
        message.includes("hi")
    ) {

        return "Hello 👋 Welcome to WasteWise!";

    }

    else if (
        message.includes("recycle")
    ) {

        return "Recycling helps reduce pollution and saves natural resources ♻️";

    }

    else if (
        message.includes("plastic")
    ) {

        return "Plastic waste takes hundreds of years to decompose.";

    }

    else if (
        message.includes("compost")
    ) {

        return "Composting converts organic waste into nutrient-rich fertilizer 🌱";

    }

    else if (
        message.includes("waste")
    ) {

        return "Proper waste management keeps our environment clean and healthy.";

    }

    else if (
        message.includes("paper")
    ) {

        return "Paper is biodegradable and recyclable 📄";

    }

    else if (
        message.includes("ewaste")
    ) {

        return "E-waste means discarded electronic devices like phones and laptops.";

    }

    else if (
        message.includes("contact")
    ) {

        return "You can contact WasteWise through the Contact section of the website.";

    }

    else {

        return "Sorry 😅 I only answer waste management related questions.";

    }

}


function generateResponse(userMessage) {

    let aiChatBox =
        document.createElement("div");

    aiChatBox.classList.add("chat-box");

    let aiBubble =
        document.createElement("div");

    aiBubble.classList.add(
        "chat-bubble",
        "ai-chat"
    );

    aiBubble.textContent =
        botReply(userMessage);

    aiChatBox.appendChild(aiBubble);

    chatContainer.appendChild(aiChatBox);

    chatContainer.scrollTop =
        chatContainer.scrollHeight;

}


function handleUserMessage() {

    let userMessage =
        promptInput.value.trim();

    if (!userMessage) return;

    let userChatBox =
        document.createElement("div");

    userChatBox.classList.add("chat-box");

    let userBubble =
        document.createElement("div");

    userBubble.classList.add(
        "chat-bubble",
        "user-chat"
    );

    userBubble.textContent =
        userMessage;

    userChatBox.appendChild(userBubble);

    chatContainer.appendChild(userChatBox);

    chatContainer.scrollTop =
        chatContainer.scrollHeight;

    promptInput.value = "";

    setTimeout(() => {

        generateResponse(userMessage);

    }, 500);

}


promptInput.addEventListener(
    "keydown",
    (e) => {

        if (e.key === "Enter") {

            handleUserMessage();

        }

    }
);

submitBtn.addEventListener(
    "click",
    handleUserMessage
);