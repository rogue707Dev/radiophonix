import {Saga} from "~types/Saga";
import {Track} from "~types/Track";

export interface Tick {
    saga: Saga;

    track: Track;

    progress: number;
}

export interface FrontTick {
    saga: string;
    track: string;
    progress: number;
}
