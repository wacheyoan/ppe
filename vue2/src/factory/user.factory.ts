import { User } from "@/interfaces/user.interface";
import ActivityFactory from "@/factory/activity.factory";
import ObjectiveFactory from "@/factory/objective.factory";

export default {
    formatRawUserToUser(rawUser: Readonly<any>): User {
        return {
            id: rawUser.id,
            email: rawUser.email,
            pseudo: rawUser.pseudo,
            height: rawUser.height,
            weight: rawUser.weight,
            phone: rawUser.phone,
            roles: rawUser.roles,
            firstName: rawUser.firstName,
            lastName: rawUser.lastName,
            birthDate: new Date(rawUser.birthDate),
            gender: rawUser.gender,
            createdAt: new Date(rawUser.createdAt),
            activity: ActivityFactory.formatRawActivityToActivity(rawUser.activity),
            objective: ObjectiveFactory.formatRawObjectiveToObjective(rawUser.objective)
        }
    }
}
