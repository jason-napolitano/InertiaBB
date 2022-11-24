/** Base Interface */
export interface BaseInterface {
  created_at: string
  updated_at: string
  deleted_at: string
}

export interface ErrorsInterface {}

/** Permission Interface */
export interface PermissionInterface extends BaseInterface {}

/** Role Interface */
export interface RoleInterface extends BaseInterface {}

/** User Interface */
export interface UserInterface extends BaseInterface {
  name: string
  username: string
  email: string
  image: string
}

/** Forum Interface */
export interface ForumInterface extends BaseInterface {
  name: string
  threads: ThreadInterface
  links: any
  data: any
  user: UserInterface
  user_id: number
  uuid: string
  content: string
}

/** Thread Interface */
export interface ThreadInterface extends BaseInterface {
  name: string
  forum: ForumInterface
  links: object
  data: any
  forum_id: number
  user: UserInterface
  user_id: number
  uuid: string
  content: string
  posts: PostInterface
}

/** Post Interface */
export interface PostInterface extends BaseInterface {
  name: string
  thread: ThreadInterface
  user: UserInterface
  thread_id: number
  user_id: number
  content: string
}
