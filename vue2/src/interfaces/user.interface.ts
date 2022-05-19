import {Activity} from "@/interfaces/activity.interface";
import {Objective} from "@/interfaces/objective.interface";

export interface User {
  id: number;
  email: string;
  pseudo: string;
  height: number;
  weight: number;
  phone: string;
  roles: [];
  createdAt: Date;
  firstName: string;
  lastName: string;
  birthDate: Date;
  gender:string;
  activity: Activity | null;
  objective: Objective | null;
}
