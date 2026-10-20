import { storeModuleFactory } from "../../js/services/store/index";
import type { Note, CreateNote, UpdateNote } from './types';


export const noteStore = storeModuleFactory<
   Note,
   CreateNote,
   UpdateNote
>("notes");