class Event {
    /**
     * Create a new Errors instance.
     */
    constructor() {
        this.vue = new Vue();
    }

    fire(event, data = null){
        this.vue.$emit(event, data);
    }

    listen(event, callback){
        this.vue.$on(event, callback);
    }
}

export default Event;