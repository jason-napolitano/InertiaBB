import type { Config } from '@jest/types'
// Sync object
const config: Config.InitialOptions = {
  preset: 'ts-jest',
  testEnvironment: 'node',
  rootDir: './resources/tests',
  verbose: true,
  transform: {
    '^.+\\.tsx?$': 'ts-jest',
  },
}
export default config
