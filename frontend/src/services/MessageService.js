import { reactive } from 'vue'

class MessageProvider {
    _messages = reactive([])
    TIMEOUT = 5000
    addMessage(message, type, isToast) {
        const id = Math.random();
        this._messages.push({ message, type, id });

        if (isToast) {
            setTimeout(() => { this.deleteMessage(id) }, this.TIMEOUT)
        }
    }

    deleteMessage(id) {
        const index = this._messages.findIndex(msg => msg.id === id);
        if (index > -1) this._messages.splice(index, 1);
    }

    getMessages() {
        return this._messages
    }
}

const message = new MessageProvider();

export default message