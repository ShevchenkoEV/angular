import { User } from "./user";

export interface ResponseHttpRegisration {
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