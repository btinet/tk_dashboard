/*
 * Copyright (c) 2022. Benjamin Wagner
 */



export default class Ausgabe {

    start;
    ende;
    ausgabe = '';

    constructor(start = 1, ende = 1) {
        this.start = start;
        this.ende = ende;
        this.addLines({});
    }

    /**
     * @start int inclusive
     * @ende int inclusive
     */
    addLines = ({start = this.start, ende = this.ende}) => {
        for(let i = start; i <= ende; i++)
        {
            let line = "<span style='font-size:"+ i +"px'>Schriftgröße " + i + "</span><br>";
            this.ausgabe += line;
        }
    };

    getAusgabe = () => this.ausgabe;
}