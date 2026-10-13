import { storeModuleFactory } from "../../js/services/store/index";
import type { Reply, CreateReply, UpdateReply } from './types';


export const replyStore = storeModuleFactory<
   Reply,
   CreateReply,
   UpdateReply
>("replies");