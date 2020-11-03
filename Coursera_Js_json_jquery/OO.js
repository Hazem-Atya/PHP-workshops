function PartyAnimal() {
    this.x=0;
    this.party=function (){
        this.x++;
        console.log("So far "+this.x);
    }
}
an=new PartyAnimal();
an.party();



/*---------------------------------------------*/
function PartyAnimal2(nam) {
    this.x = 0;
    this.name = nam;
    console.log("Built "+nam);
    this.party = function () {
        this.x = this.x + 1;
        console.log(nam+"="+this.x);
    }
}
a=new PartyAnimal2('Hazem');
a.party();
