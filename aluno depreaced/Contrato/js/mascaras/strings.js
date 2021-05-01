class StringsFunctions{
    constructor(){

    }

    replaceAll(){
        String.prototype.replaceAll = String.prototype.replaceAll || function(needle, replacement) {
            return this.split(needle).join(replacement);
        };
    }
}