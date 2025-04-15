class MessageProvider{
    _messages = []
    TIMEOUT = 5000
    addMessage(message, type, isToast){
        const id = Math.random();
        this._messages.push({message, type, id});

        if(isToast){
            setTimeout(()=>{this.deleteMessage(id)}, this.TIMEOUT)
        }
    }

    deleteMessage(id){
        this._message = this._messages.filter((msg, i) => msg.id !== id);
    }
}

export default message = new MessageProvider();