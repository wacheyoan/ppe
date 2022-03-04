import activityRepository from "@/repository/activity.repository";
import activityFactory from "@/factory/activity.factory";
import {Activity} from "@/interfaces/activity.interface";

export default {
    async getAllActivities(): Promise<Activity[]> {
        const rawActivities = await activityRepository.getAllActivities();
        const activities: Activity[] = [];
        rawActivities['hydra:member'].forEach((rawActivity: any) => {
            activities.push(activityFactory.formatRawActivityToActivity(rawActivity));
        })
        return activities;
    }
}