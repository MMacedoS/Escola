class DatasValidate{
    constructor(){
        this.ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
    }
    
    validaData(item,validateDias = false,atual = false){
        if (item.value.length < 10) {
            return item.value;
        }
        let data_partes = item.value.split('/');
        let dia = parseInt(data_partes[0]);
        let mes = parseInt(data_partes[1]);
        let ano = parseInt(data_partes[2]);

        if (this.validaAnoBisexto(ano)) {
            this.setFervereiroBisexto(29);
        }else{
            this.setFervereiroBisexto(28);
        }

        mes = this.getValidaMes(mes);
        dia = this.getValidaDia(dia,this.ListofDays[mes-1]);

        dia = this.setZero(dia);
        mes = this.setZero(mes);

        let newDate = `${dia}/${mes}/${ano}`;

        newDate = this.validaMenorNow(validateDias,newDate,atual);

        return newDate;
    }

    validaMenorNow(validateDias,date,atual){
        let now = new Date();
        if (validateDias) {
            if (this.subDatesDays(date) > 0) {
                alert('Data informada inferior a data atual.');
                return (atual) ? `${this.setZero(now.getDate())}/${this.setZero(now.getMonth()+1)}/${now.getFullYear()}` : '';
            }
        }
        return date;
    }

    subDatesDays(date){
        date = this.formatDateUs(date);
        let now = new Date(); // Data de hoje
        now = new Date(`${now.getFullYear()}-${now.getMonth()+1}-${now.getDate()} 00:00:00`);
        const past = new Date(date+" 00:00:00"); // Outra data no passado
        const diff = now.getTime() - past.getTime(); // Subtrai uma data pela outra
        const days = Math.ceil(diff / (1000 * 60 * 60 * 24));
        return days;
    }

    subDates(date1, date2){
        date1 = this.formatDateUs(date1);
        date2 = this.formatDateUs(date2);

        date1 = new Date(date1);
        date2 = new Date(date2);

        return date1.getTime() - date2.getTime();
    }

    subDatesNow(date1){
        date1 = this.formatDateUs(date1);
        date1 = new Date(date1+" 23:59:59");
        date2 = new Date();

        return date1.getTime() - date2.getTime();
    }

    setZero(numero){
        numero = numero+'';
        return (numero.length == 1) ? `0${numero}`: numero;
    }
    
    getValidaDia(dia, quantidadeDiasMes){
        let retorno = dia;
        if (dia > quantidadeDiasMes) {
            retorno = quantidadeDiasMes;
        }
        if (dia < 1) {
            retorno = 1;
        }
        return retorno;
    }

    getValidaMes(mes){
        let retorno = mes;
        if (mes > 12) {
            retorno = 12;
        }
        if (mes < 1) {
            retorno = 1;
        }
        return retorno;
    }

    setFervereiroBisexto(dias){
        this.ListofDays[1] = dias;
    }

    validaAnoBisexto(ano){
        if ((ano % 4 == 0) && ((ano % 100 != 0) || (ano % 400 == 0))) 
        {
            return true;
        }
        return false;
    }

    formatDateBr(date){
        if (date != '') {
            let partes = date.split('-');
            return partes[2]+"/"+partes[1]+"/"+partes[0];
        }
        return '';
    }

    formatDateUs(date){
        if (date != '') {
            let partes = date.split('/');
            return partes[2]+"-"+partes[1]+"-"+partes[0];
        }
        return '';
    }
}