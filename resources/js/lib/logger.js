const LEVELS = { debug: 10, info: 20, warn: 30, error: 40 };

const minLevel = (() => {
  const env = (process.env.LOG_LEVEL || "info").toLowerCase();
  return LEVELS[env] ?? LEVELS.info;
})();

function emit(level, msg, ctx) {
  if (LEVELS[level] < minLevel) return;
  const record = { ts: new Date().toISOString(), level, msg, ...ctx };
  const line = JSON.stringify(record);
  const out = level === "error" || level === "warn" ? process.stderr : process.stdout;
  out.write(line + "\n");
}

export function createLogger(context = {}) {
  return {
    debug: (msg, ctx = {}) => emit("debug", msg, { ...context, ...ctx }),
    info: (msg, ctx = {}) => emit("info", msg, { ...context, ...ctx }),
    warn: (msg, ctx = {}) => emit("warn", msg, { ...context, ...ctx }),
    error: (msg, ctx = {}) => emit("error", msg, { ...context, ...ctx }),
    child: (extra = {}) => createLogger({ ...context, ...extra }),
  };
}
