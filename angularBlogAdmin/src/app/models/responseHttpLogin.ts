import {User} from "./user";

export interface ResponseHttpLogin {
    status: boolean,
    errors: {
        message?: string
    },
    data: {
        user: User,
        api_token: string,
        token_type: string,
        expires_at: string
    }
}